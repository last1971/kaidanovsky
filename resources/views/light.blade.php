@extends('layout')

@section('content')
    <div class="prev-next">
        <div>
            <a href="{{ route('welcome') }}">назад</a>
            <span></span>
            <a href="{{ route('create-order', ['color' => 'light']) }}">далее</a>
        </div>
    </div>
    <main>
        <div class="big-img">
            <img alt="светлый вариант" src="/img/kaydanovsky_1_big.jpg">
        </div>
        <p>
            Вы выбрали светлый вариант открытки.
        </p>

    </main>
@endsection
