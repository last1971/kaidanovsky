@extends('layout')

@section('header')
    <style>
        .order{
            display: grid;
            grid-template-columns: 30% 70%;
            gap: 10px;
            margin: 20px 0;
        }
        .refund {
            margin: 30px 0;
        }
    </style>
    <script>
        function fnOnload(){}
        function fnRefund(){
            const l = '{{ $order->amount }}'.split('.')[0]
            const q = prompt(`Наберите ${l} чтобы вернуть деньги. Заказ в этом случае анулируется`);
            if (q === l) {
                window.location.href='{{ route('refund', compact('order')) }}'
            }
        }
    </script>
@endsection

@section('content')
    <main>
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
                    Ошибка оплаты, <a href="{{ route('recreate', compact('order')) }}">попробуйте еще раз</a>!
                @elseif($order->status === 'WAITING_FOR_3DS')
                    Ожидание 3DS
                @elseif($order->status === 'REFUNDED')
                    Оплата возвращена. Заказ анулирован.
                @else
                    неопределённый ({{$order->status}})
                @endif
        </span>
        </div>

        @if($order->status === 'COMPLETE')
            <div class="refund">
                Если вы передумали и не хотите получить замечательную юбилейную открытку, вы можете
                <a href="{{ route('refund', compact('order')) }}">вернуть оплату</a> в размере {{ $order->amount }} руб.
            </div>

        @endif

        <div class="prev-next">
            <div>
                @if ($order->status === 'COMPLETE')
                    <a href="javascript: fnRefund()">Вернуть оплату</a>
                @elseif($order->status === 'FAILED')
                    <a href="{{ route('recreate', compact('order')) }}">Оплатить</a>
                @elseif($order->status === 'PROCESSING')
                    <a href="{{ route('recreate', compact('order')) }}">Оплатить</a>
                @elseif($order->status === 'WAITING_FOR_3DS')
                    <a href="{{ route('recreate', compact('order')) }}">Оплатить</a>
                @else
                    <span></span>
                @endif
                <span></span>
                <a href="/">На главную</a>
            </div>
        </div>
    </main>

@endsection
