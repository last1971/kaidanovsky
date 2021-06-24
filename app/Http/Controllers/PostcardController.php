<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostcardRequest;
use App\Mail\OrderCreated;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class PostcardController extends Controller
{
    /**
     * @param PostcardRequest $request
     * @return RedirectResponse
     */
    public function create(PostcardRequest $request)
    {
        $order = Order::query()->create($request->all());
        Mail::to($order->email)->queue(new OrderCreated($order));
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
}
