@extends('layout')

@section('content')
    <div>Заполните пожалуйста Ваши данные</div>
    <form method="POST" action="{{ route('create') }}">
        @csrf
        <div>
            <span>Вы выбрали</span>
            @php
                $color = old('color') ?? request('color')
            @endphp
            <label for="color">
                @if ($color === 'black')
                    Черная открытка
                @else
                    Белая открытка
                @endif
            </label>
            <input id="color" name="color" value="{{ $color }}" hidden>
        </div>
        <div>
            <label for="name">Кому</label>
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
            <label for="address">Куда</label>
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
