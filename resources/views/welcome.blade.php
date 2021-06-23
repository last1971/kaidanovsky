@extends('layout')

@section('content')
    Здесь можно
    <a href="{{ route('postcard') }}">получить открытку</a>
    , с маркой погашенной в День Рождения актера
    <a href="https://ru.wikipedia.org/wiki/%D0%9A%D0%B0%D0%B9%D0%B4%D0%B0%D0%BD%D0%BE%D0%B2%D1%81%D0%BA%D0%B8%D0%B9,_%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80_%D0%9B%D0%B5%D0%BE%D0%BD%D0%B8%D0%B4%D0%BE%D0%B2%D0%B8%D1%87">
        Александра Леонидовича Кайдановского
    </a>
@endsection
