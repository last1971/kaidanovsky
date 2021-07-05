@extends('layout')

@section('content')
    <style>
        .select-cards {
            max-width: 596px;
            margin: 0 auto 20px auto;
        }
        .select-cards a {
            display: inline-block;
            width: calc(50% - 10px);
            max-width: 288px;
            text-align: center;
        }
        .select-cards a:first-child {
            margin-right: 10px;
        }
        .select-cards a img {
            width: 100%;
        }
        .card-back {
            width: 90%;
            margin: 0 auto 10px auto;
            max-width: 596px;
        }
        .card-back img {
            width: 100%
        }
    </style>
    <main>
        <h1>Юбилей Кайдановского</h1>
        <p>
            23 июля 2021 года исполняется 75 лет со дня рождения Александра Кайдановского.
        </p>
        <p>
            Закажите и получите по почте открытку с гашением марки печатью одного дня. Мы отправим её вам 23 июля 2021г. из Ростова-на-Дону. Стоимость открытки 420 - 480 рублей, доставка в любую точку планеты Земля вхоит в стоимость.
        </p>

        <h2>Выберите варинт открытки:</h2>

        <div class="select-cards">
            <a href="{{ route('dark') }}">
                <img alt="тёмный вариант" src="/img/kaydanovsky_2_small.jpg"><br>
                <span>тёмный вариант</span>
            </a>
            <a href="{{ route('light', ['color' => 'white']) }}">
                <img alt="светлый вариант" src="/img/kaydanovsky_1_small.jpg"><br>
                <span>светлый вариант</span>
            </a>
        </div>

        <div>Юбилейные открытки созданы ещё одним замечательным ростованином - Владимиром Овекиным. Созданы с любовью.</div>
        <div>
            <p>Обратная сторона открытки:</p>
            <div class="card-back">
                <img alt="обратная сторона открытки" src="/img/card_back.jpg">
            </div>
        </div>
    </main>
@endsection
