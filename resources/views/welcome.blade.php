@extends('layout')

@section('content')
    <header>
        <p>
            23 июля 2021 года великому ростовчанину, Александру Кайдановскому исполнилось бы 75 лет. Александр Леонидович ушел от нас в 1995, но мы помним замечательного актера, прекрасного режиссера и замечательного человека.
        </p>
        <p>
            У вас есть редкий шанс получить по почте открытку с гашением марки печатью одного дня, отправленную 23 июля из Ростова-на-Дону. Стоимость открытки 450 рублей, доставка в любую точку планеты Земля бесплатно.
        </p>
    </header>
    Здесь можно !!!!
    <div>
        <a href="{{ route('create-order', ['color' => 'black']) }}">получить черную открытку</a>
    </div>
    <div>
        <a href="{{ route('create-order', ['color' => 'white']) }}">получить белую открытку</a>
    </div>
    , с маркой погашенной в День Рождения актера
    <a href="https://ru.wikipedia.org/wiki/%D0%9A%D0%B0%D0%B9%D0%B4%D0%B0%D0%BD%D0%BE%D0%B2%D1%81%D0%BA%D0%B8%D0%B9,_%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80_%D0%9B%D0%B5%D0%BE%D0%BD%D0%B8%D0%B4%D0%BE%D0%B2%D0%B8%D1%87">
        Александра Леонидовича Кайдановского
    </a>
@endsection
