@extends('layout')

@section('content')
    <div class="prev-next">
        <div>
            <a href="{{ route('welcome') }}">назад</a>
            <span></span>
            <a href="{{ route('create-order', ['color' => 'dark']) }}">далее</a>
        </div>
    </div>
    <main>
        <div class="big-img">
            <img  alt="тёмный вариант" src="/img/kaydanovsky_2_big.jpg">
        </div>
        <p>
            Вы выбрали тёмный вариант открытки.
        </p>
    </main>
@endsection
