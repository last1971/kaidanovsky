<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostcardRequest;
use App\Mail\OrderCreated;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class PostcardController extends Controller
{
    public function create(PostcardRequest $request)
    {
        $order = Order::query()->create($request->all());
        Mail::to($order->email)->queue(new OrderCreated($order));
        return redirect()->action([PostcardController::class, 'order'], compact('order'));
    }

    public function createOrder()
    {
        return view('create-order');
    }

    public function order(Order $order)
    {
        return view('order', compact('order'));
    }
}
