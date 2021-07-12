@extends('layout')

@section('header')
<style>
    .order{
        display: grid;
        grid-template-columns: 30% 70%;
        gap: 10px;
        margin: 20px 0;
    }
</style>
@endsection

@section('content')
    <h1>Ваш заказ</h1>
    <div class="order">
        <span>Кому</span><span>{{ $order->name }}</span>
        <span>Индекс</span><span>{{ $order->index }}</span>
        <span>Куда</span><span>{{ $order->address }}</span>
        <span>Email</span><span>{{ $order->email }}</span>
        <span>Телефон</span><span>{{ $order->phone }}</span>
        <span>Тип</span>
        <span>
            @if ($order->color === 'dark')
                тёмная открытка
            @else
                светлая открытка
            @endif
        </span>
        <span>Стоимость</span><span>{{ $order->amount }} руб.</span>
        <span>Статус оплаты</span>
        <span>
            @if ($order->status === 'COMPLETE')
                Оплата поступила
            @elseif($order->status === 'PROCESSING')
                Оплата обрабатывается
            @elseif($order->status === 'FAILED')
                Ошибка оплаты, <a href="">попробуйте еще раз</a>!
            @elseif($order->status === 'WAITING_FOR_3DS')
                Ожидание 3DS
            @else
                неопределнный
            @endif
        </span>
    </div>

    @if($order->status === 'paid')
        <button>Refund</button>
    @endif
@endsection
