<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostcardRequest;
use App\Http\Resources\OrderResource;
use App\Mail\OrderCreated;
use App\Models\Order;
use App\Services\ModulBankService;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PostcardController extends Controller
{

    public function create(PostcardRequest $request)
    {
        $order = Order::query()->create($request->all());
        Mail::to($order->email)->queue(new OrderCreated($order));
        return view('pay', ['order' => new OrderResource($order)]);
    }

    public function recreate(Order $order)
    {
        $order->touch();
        $order->save();
        return view('pay', ['order' => new OrderResource($order)]);
    }

    public function refund(Order $order, ModulBankService $service)
    {
        try {
            $res = $service->refund($order);
            if ($res->refund->state !== 'FAILED') {
                $order->status = 'REFUNDED';
                $order->save();
            }
        } catch (Exception $e)
        {
            Log::error($e->getMessage());
            abort(500);
        }
        return redirect()->action([PostcardController::class, 'order'], compact('order'));
    }

    /**
     * @return Application|Factory|View
     */
    public function createOrder()
    {
        return view('create-order');
    }

    /**
     * @param Order $order
     * @return Application|Factory|View
     */
    public function order(Order $order)
    {
        return view('order', compact('order'));
    }

    /**
     * @param Request $request
     * @param ModulBankService $service
     * @return RedirectResponse
     * @throws GuzzleException
     */
    public function success(Request $request, ModulBankService $service)
    {
        $order = $request->get('transaction_id')
            ? $service->getOrder($request->get('transaction_id'))
            : null;
        if ($order) return redirect()->action([PostcardController::class, 'order'], compact('order'));
        if ($order === false) abort(400, 'Ошибка МодульБанка');
        abort(404);
        return null;
    }
}
