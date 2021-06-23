<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostcardRequest;
use App\Models\Order;

class PostcardController extends Controller
{
    public function create(PostcardRequest $request)
    {
        $order = Order::query()->create($request->all());
        return redirect()->action([PostcardController::class, 'order'], compact('order'));
    }

    public function createPostcard()
    {
        return view('postcard');
    }

    public function order(Order $order)
    {
        return view('order', compact('order'));
    }
}
