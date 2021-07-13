<?php


namespace App\Services;


use App\Models\Order;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ModulBankService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => env('MODUL_BASE_URI', 'https://pay.modulbank.ru')]);
    }

    /**
     * @param $data
     * @return string
     */
    private function doubleSha1($data)
    {
        for ($i = 0; $i < 2; $i++) {
            $data = sha1(env('MODUL_SECRET_KEY', '00112233445566778899aabbccddeeff') . $data);
        }
        return $data;
    }

    /**
     * @param array $params
     * @param string $key
     * @return string
     */
    public function getSignature(array $params, $key = 'signature')
    {
        $keys = array_keys($params);
        sort($keys);
        $chunks = array();
        foreach ($keys as $k) {
            $v = (string) $params[$k];
            if (($v !== '') && ($k != $key)) {
                $chunks[] = $k . '=' . base64_encode($v);
            }
        }
        $data = implode('&', $chunks);

        return $this->doubleSha1($data);
    }

    /**
     * @param string $id
     * @return mixed
     * @throws GuzzleException
     */
    public function getTransaction(string $id)
    {
        $query = [
            'transaction_id' => $id,
            'merchant' => env('MODUL_MERCHANT', 'ad25ef06-1824-413f-8ef1-c08115b9b979'),
            'unix_timestamp' => Carbon::now()->unix(),
            'salt' => Str::random()
        ];
        $query['signature'] = $this->getSignature($query);
        $response = $this->client->request(
            'GET',
                'api/v1/transaction',
            compact('query'),
        );
        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param string $transactionId
     * @return Builder|Builder[]|Collection|Model|boolean|null
     * @throws GuzzleException
     */
    public function getOrder(string $transactionId)
    {
        try {
            $response = $this->getTransaction($transactionId);
            $order = Order::query()->find($response->transaction->order_id);
            if ($order) {
                $order->transaction_id = $response->transaction->transaction_id;
                $order->status = $response->transaction->state;
                $order->save();
            }
            return $order;
        } catch (Exception $e) {
            return false;
        }
    }

    public function refund(Order $order)
    {
        $form_params = [
            'merchant' => env('MODUL_MERCHANT', 'ad25ef06-1824-413f-8ef1-c08115b9b979'),
            'amount' => $order->amount,
            'transaction' => $order->transaction_id,
            'unix_timestamp' => Carbon::now()->unix(),
            'salt' => Str::random()
        ];
        $form_params['signature'] = $this->getSignature($form_params);
        $response = $this->client->request(
            'POST',
            'api/v1/refund',
            compact('form_params'),
        );
        return json_decode($response->getBody()->getContents());
    }
}
