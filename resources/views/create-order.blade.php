@extends('layout')

@section('content')
    <div>Заполните пожалуйста Ваши данные</div>
    <form method="POST" action="{{ route('create') }}">
        @csrf
        <div>
            <label for="name">Ф.И.О.</label>
            <input id="name" name="name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="index">Индекс</label>
            <input id="index" name="index" class="@error('index') is-invalid @enderror" value="{{ old('index') }}">
            @error('index')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="region">Регион</label>
            <input id="region" name="region" class="@error('region') is-invalid @enderror" value="{{ old('region') }}">
            @error('region')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="locality">Населенный пункт</label>
            <input id="locality"
                   name="locality"
                   class="@error('locality') is-invalid @enderror"
                   value="{{ old('locality') }}"
            >
            @error('locality')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="address">Адрес</label>
            <input id="address"
                   name="address"
                   class="@error('address') is-invalid @enderror"
                   value="{{ old('address') }}"
            >
            @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email">Email</label>
            <input id="email"
                   name="email"
                   type="email"
                   class="@error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
            >
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="phone">Телефон</label>
            <input id="phone" name="phone" class="@error('phone') is-invalid @enderror" value="{{ old('phone') }}">
            @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <span>Цвет</span>
            <label for="color_black">Черный</label>
            <input id="color_black" name="color" type="radio" value="black" checked>
            <label for="color_white">Белый</label>
            <input id="color_white" name="color" type="radio" value="white">
        </div>
        <div>
            <label for="promocode">Промокод</label>
            <input id="promocode"
                   name="promocode"
                   class="@error('promocode') is-invalid @enderror"
                   value="{{ old('promocode') }}"
            >
            @error('promocode')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <input type="submit" value="Оплатить">
        </div>
    </form>
@endsection
