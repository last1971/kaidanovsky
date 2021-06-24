<?php


namespace App;


use GuzzleHttp\Client;

class ModulBankService
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * ModulBankService constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param string $data
     * @return string
     */
    private function doubleSha1(string $data): string
    {
        for ($i = 0; $i < 2; $i++) {
            $data = sha1(env('MODUL_SECRET_KEY','00112233445566778899aabbccddeeff') . $data);
        }
        return $data;
    }

    /**
     * @param array $params
     * @param string $key
     * @return string
     */
    private function getSignature(array $params, $key = 'signature'): string
    {
        $keys = array_keys($params);
        sort($keys);
        $chunks = array();
        foreach ($keys as $k) {
            $v = (string) $params[$k];
            if (($v !== '') && ($k != 'signature')) {
                $chunks[] = $k . '=' . base64_encode($v);
            }
        }
        $data = implode('&', $chunks);

        return $this->doubleSha1($data);

    }

    public function pay(array $items)
    {

    }

}
