@extends('layout')

@section('content')
    <div>Ваш заказ</div>
    <div>
        <span>Кому</span><span>{{ $order->name }}</span>
    </div>
    <div>
        <span>Индекс</span><span>{{ $order->index }}</span>
    </div>
    <div>
        <span>Куда</span><span>{{ $order->address }}</span>
    </div>
    <div>
        <span>Email</span><span>{{ $order->email }}</span>
    </div>
    <div>
        <span>Телефон</span><span>{{ $order->phone }}</span>
    </div>
    <div>
        <span>Цвет</span><span>{{ $order->color }}</span>
    </div>
    <div>
        <span>Стоимость</span><span>{{ $order->amount }} руб.</span>
    </div>
    <div>
        <span>Статус</span><span>{{ $order->status }}</span>
    </div>
    @if($order->status === 'paid')
        <button>Refund</button>
    @endif
@endsection
