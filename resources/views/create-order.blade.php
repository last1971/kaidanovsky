@extends('layout')

@section('header')
    <style>
        .hint {
            margin: 0 40px 40px 20px;
            text-indent: 0;
            font-size: 0.9em;
            line-height: 1em;
            color: gray;
        }
        .class-holder {
            width: 100%;
            height: auto;
            position: relative;
        }
        .img-thumb {
            position: absolute;
            top: -10PX;
            right: 0;
            width: 100px;
            border-bottom-left-radius: 20px;
            opacity: 0.25;
        }
        .prev-next {
            margin-bottom: 50px;
        }
        .input-field {
            position: relative;
            border: solid 1px gray;
            border-radius: 4px;
            width: calc(100% - 20px);
            margin: 20px auto;
        }
        .input-field input, .input-field textarea {
            font-size: 1.25em;
            outline: none;
            border: none;
            width: calc(100% - 20px);
            margin: 10px auto;
            display: block;
            padding: 0;
        }
        .input-field textarea {
            height: 90px;
            max-width: calc(100% - 20px);
            max-height: 150px;
        }
        .input-field label {
            position: absolute;
            display: inline-block;
            top: -10px;
            left: 10px;
            background-color: white;
            padding: 0 10px;
            font-size: 0.75em;
            text-transform: uppercase;
            font-weight: 900;
            color: #333333;
        }
        .input-field label.counter {
            top: inherit;
            left: inherit;
            bottom: -15px;
            right: 15px;
            border:  solid 1px gray;
            border-radius: 4px;
            color: silver;
            font-weight: 300;
            font-size: 0.75em;
        }
        .input-field label.alert {
            left: inherit;
            right: 10px;
            background-color: red;
            color: #f0f0f0;
            border-radius: 4px;
        }
        .is-invalid {
            border-color: red;
        }
        .send-holder {
            margin: 30px 0;
        }
        .send-holder input[type=submit] {
            background-color: white;
            height: 50px;
            width: 50%;
            max-width: 300px;
            padding: 10px;
            margin: 0 auto;
            display: block;
        }
        hr {
            width: 62%;
            margin: 40px auto;
        }
    </style>
    <script>
        function fnChange(element) {
            const input = element.parentElement.querySelector('input,textarea');
            const counter = element.parentElement.querySelector('.counter');
            const len = input.value.length
            const max = input.getAttribute('maxlength');
            counter.innerHTML = `${len} / ${max}`;
            fnSaveToLocalStorage(element.id);
        }
        function fnOnload(){
            if (localStorage.getItem('name') && !'{{ old('name') }}') {
                document.getElementById('name').value = localStorage.getItem('name');
            }

            if (localStorage.getItem('address') && !'{{ old('address') }}') {
                document.getElementById('address').value = localStorage.getItem('address');
            }

            if (localStorage.getItem('index') && !'{{ old('index') }}') {
                document.getElementById('index').value = localStorage.getItem('index');
            }

            if (localStorage.getItem('email') && !'{{ old('email') }}') {
                document.getElementById('email').value = localStorage.getItem('email');
            }

            if (localStorage.getItem('phone') && !'{{ old('phone') }}') {
                document.getElementById('phone').value = localStorage.getItem('phone');
            }

            if (localStorage.getItem('social') && !'{{ old('social') }}') {
                document.getElementById('social').value = localStorage.getItem('social');
            }

            if (localStorage.getItem('customFrom') != null && !'{{ old('customFrom') }}') {
                document.getElementById('customFrom').checked = localStorage.getItem('customFrom');
            }

            if (localStorage.getItem('isCustomText') != null && !'{{ old('isCustomText') }}') {
                document.getElementById('isCustomText').checked = localStorage.getItem('isCustomText');
            }

            if (localStorage.getItem('isSocial') != null && !'{{ old('isSocial') }}') {
                document.getElementById('isSocial').checked = localStorage.getItem('isSocial');
            }

            document.getElementById('fromName').setAttribute('data-default', 'Киноклуб K-INO.RU');
            document.getElementById('fromName').setAttribute('data-custom', '{{ old('fromName') }}');
            if (document.getElementById('customFrom').checked) {
                document.getElementById('fromName').value = '{{ old('fromName') }}' || localStorage.getItem('fromName');
            } else {
                document.getElementById('fromName').value = document.getElementById('fromName').getAttribute('data-default');
                document.getElementById('fromName').setAttribute('readonly', 'readonly');
            }

            document.getElementById('fromAddress').setAttribute('data-default', 'г. Ростов-на-Дону, а/я 5560');
            document.getElementById('fromAddress').setAttribute('data-custom', '{{ old('fromAddress') }}');
            if (document.getElementById('customFrom').checked) {
                document.getElementById('fromAddress').innerText = '{{ old('fromAddress') }}' || localStorage.getItem('fromAddress');
            } else {
                document.getElementById('fromAddress').innerText = document.getElementById('fromAddress').getAttribute('data-default');
                document.getElementById('fromAddress').setAttribute('readonly', 'readonly');
            }

            document.getElementById('fromIndex').setAttribute('data-default', '344016');
            document.getElementById('fromIndex').setAttribute('data-custom', '{{ old('fromIndex') }}');
            if (document.getElementById('customFrom').checked) {
                document.getElementById('fromIndex').value = '{{ old('fromIndex') }}' || localStorage.getItem('fromIndex');
            } else {
                document.getElementById('fromIndex').value = document.getElementById('fromIndex').getAttribute('data-default');
                document.getElementById('fromIndex').setAttribute('readonly', 'readonly');
            }

            document.getElementById('customText').setAttribute('data-default', 'Пусть исполнится то, что задумано!');
            document.getElementById('prevCustomText').innerText = document.getElementById('customText').getAttribute('data-default');
            document.getElementById('customText').setAttribute('data-custom', '{{ old('customText') }}');
            if (document.getElementById('isCustomText').checked) {
                document.getElementById('customText').value = '{{ old('customText') }}' || localStorage.getItem('customText');
            } else {
                document.getElementById('customText').value = document.getElementById('customText').getAttribute('data-default');
                document.getElementById('customText').setAttribute('readonly', 'readonly');
            }

            if (document.getElementById('isSocial').checked) {
                document.getElementById('summ').innerText = '420';
            }

            fnRecalculateLen()

            const firstError = document.getElementsByClassName('alert').length ? document.getElementsByClassName('alert')[0] : null;
            if (firstError) {
                firstError.scrollIntoView();
            }

        }

        function fnRecalculateLen(){
            for (let element of document.getElementsByClassName('counter')){
                const input = element.parentElement.querySelector('input,textarea');
                const counter = element.parentElement.querySelector('.counter');
                const len = input.value.length
                const max = input.getAttribute('maxlength');
                counter.innerHTML = `${len} / ${max}`;
            }
        }

        function fnChangeSocial(){
            if (document.getElementById('isSocial').checked) {
                document.getElementById('summ').innerText = '420';
            } else {
                document.getElementById('summ').innerText = '480';
            }

            fnSaveToLocalStorage('isSocial', document.getElementById('isSocial').checked);
        }

        function fnChangeCustomFrom(){
            if (document.getElementById('customFrom').checked) {
                document.getElementById('fromName').removeAttribute('readonly');
                document.getElementById('fromName').value = document.getElementById('fromName').getAttribute('data-custom');
                document.getElementById('fromAddress').removeAttribute('readonly');
                document.getElementById('fromAddress').value = document.getElementById('fromAddress').getAttribute('data-custom');
                document.getElementById('fromIndex').removeAttribute('readonly');
                document.getElementById('fromIndex').value = document.getElementById('fromIndex').getAttribute('data-custom');
            } else {
                document.getElementById('fromName').setAttribute('readonly', 'readonly');
                document.getElementById('fromName').setAttribute('data-custom', document.getElementById('fromName').value);
                document.getElementById('fromName').value = document.getElementById('fromName').getAttribute('data-default');
                document.getElementById('fromAddress').setAttribute('readonly', 'readonly');
                document.getElementById('fromAddress').setAttribute('data-custom', document.getElementById('fromAddress').value);
                document.getElementById('fromAddress').value = document.getElementById('fromAddress').getAttribute('data-default');
                document.getElementById('fromIndex').setAttribute('readonly', 'readonly');
                document.getElementById('fromIndex').setAttribute('data-custom', document.getElementById('fromIndex').value);
                document.getElementById('fromIndex').value = document.getElementById('fromIndex').getAttribute('data-default');
            }

            fnRecalculateLen();
            fnSaveToLocalStorage('customFrom', document.getElementById('customFrom').checked)
        }

        function fnChangeCustomText(){
            if (document.getElementById('isCustomText').checked) {
                document.getElementById('customText').removeAttribute('readonly');
                document.getElementById('customText').value = document.getElementById('customText').getAttribute('data-custom');
            } else {
                document.getElementById('customText').setAttribute('readonly', 'readonly');
                document.getElementById('customText').setAttribute('data-custom', document.getElementById('customText').value);
                document.getElementById('customText').value = document.getElementById('customText').getAttribute('data-default');
            }
            fnRecalculateLen();
            fnSaveToLocalStorage('isCustomText', document.getElementById('isCustomText').checked);
        }

        function fnSaveToLocalStorage(key, _value){
            const value = _value != null ? _value : document.getElementById(key).value;
            localStorage.setItem(key, value);
        }
    </script>
@endsection

@section('content')
    @php
        $color = old('color') ?? request('color')
    @endphp
        <div class="prev-next">
            <div>
                <a href="{{ $color === 'dark' ? route('dark') : route('light') }}">назад</a>
                <span></span>
                <span>

                </span>
            </div>
            @if ($color === 'dark')
                <img class="img-thumb"  alt="тёмный вариант" src="/img/kaydanovsky_2_big.jpg">
            @else
                <img class="img-thumb"  alt="светлый вариант" src="/img/kaydanovsky_1_big.jpg">
            @endif
        </div>

        <main>
            <form autocomplete="off" method="POST" action="{{ route('create') }}">
                @csrf
                <div>
                    <span>Вы выбрали</span>
                    <label for="color">
                        @if ($color === 'dark')
                            тёмную открытку
                        @else
                            светлую открытку
                        @endif
                    </label>
                    <input id="color" name="color" value="{{ $color }}" hidden>
                </div>
                <div class="mt-50">Заполните, пожалуйста, форму заказа. Следующие поля напишите так, как Вы бы написали их на почтовой открытке или конверте:</div>

                <div class="input-field @error('name') is-invalid @enderror">
                    <label for="name">Кому</label>
                    @error('name')
                    <label for="name" class="alert">ошибка</label>
                    @enderror
                    <input
                        placeholder="Алексееву Степану"
                        id="name"
                        name="name"
                        class="@error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        oninput="fnSaveToLocalStorage(this.id)"
                    >

                </div>

                <div class="input-field @error('address') is-invalid @enderror">
                    <label for="address">Куда</label>
                    @error('address')
                    <label class="alert">ошибка</label>
                    @enderror
                    <textarea
                        maxlength="255"
                        id="address"
                        placeholder="ул. Победы, д.20, кв.29,
п.Октябрьский, Борский р-он,
Нижегородская обл.
"
                        name="address"
                        class="@error('address') is-invalid @enderror"
                        oninput="fnChange(this)"
                    >{{ old('address') }}</textarea>
                    <label class="counter"></label>
                </div>

                <div class="input-field @error('index') is-invalid @enderror">
                    <label for="index">Индекс места назначения</label>
                    @error('index')
                    <label class="alert">ошибка</label>
                    @enderror
                    <input
                        placeholder="000000"
                        id="index"
                        name="index"
                        class="@error('index') is-invalid @enderror"
                        value="{{ old('index') }}"
                        oninput="fnSaveToLocalStorage(this.id)"
                    >
                </div>

                <hr />


                <div>
                    <input
                        {{ old('customFrom') === 'on' ? 'checked' : '' }}
                        id="customFrom"
                        name="customFrom"
                        type="checkbox"
                        onchange="fnChangeCustomFrom()"
                    >
                    <label for="customFrom">Я хочу указать другого отправителя</label>
                    <p class="hint">По умолчанию мы отправляем открытку от киноклуба K-INO.RU, но Вы можете указать себя в качестве отправителя, поставив галочку выше</p>
                </div>

                <div class="input-field @error('fromName') is-invalid @enderror">
                    <label for="fromName">От кого</label>
                    @error('fromName')
                    <label for="fromName" class="alert">ошибка</label>
                    @enderror
                    <input
                        placeholder="Евгении Николаевской"
                        id="fromName" name="fromName"
                        class="@error('fromName') is-invalid @enderror"
                        oninput="fnSaveToLocalStorage(this.id)"
                    >
                </div>

                <div class="input-field @error('fromAddress') is-invalid @enderror">
                    <label for="fromAddress">Откуда</label>
                    @error('fromAddress')
                    <label class="alert">ошибка</label>
                    @enderror
                    <textarea
                        id="fromAddress"
                        placeholder="пер. Соборный, д.12,
г. Ростов-на-Дону
"
                        name="fromAddress"
                        class="@error('fromAddress') is-invalid @enderror"
                        maxlength="255"
                        oninput="fnChange(this)"
                    ></textarea>
                    <label class="counter"></label>
                </div>

                <div class="input-field @error('fromIndex') is-invalid @enderror">
                    <label for="fromIndex">Индекс места отправления</label>
                    @error('fromIndex')
                    <label class="alert">ошибка</label>
                    @enderror
                    <input
                        placeholder="000000"
                        id="fromIndex"
                        name="fromIndex"
                        class="@error('index') is-invalid @enderror"
                        oninput="fnSaveToLocalStorage(this.id)"
                    >
                </div>

                <hr />

                <div>
                    <input
                        {{ old('isCustomText') === 'on' ? 'checked' : '' }}
                        id="isCustomText"
                        name="isCustomText"
                        type="checkbox"
                        onchange="fnChangeCustomText()"
                    >
                    <label for="isCustomText">Я хочу указать свой текст</label>
                    <p class="hint">По умолчанию мы отправляем открытку с текстом "<span id="prevCustomText">Пусть исполнится то, что задумано!</span>", но Вы можете указать собственный вариант текста, поставив галочку выше</p>
                </div>

                <div class="input-field @error('customText') is-invalid @enderror">
                    <label for="customText">Текст открытки</label>
                    @error('customText')
                    <label class="alert">ошибка</label>
                    @enderror
                    <textarea
                        id="customText"
                        name="customText"
                        class="@error('customText') is-invalid @enderror"
                        maxlength="140"
                        oninput="fnChange(this)"
                    ></textarea>
                    <label class="counter"></label>
                </div>

                <hr />


                <div class="mt-50">Укажите свою контактную инормаию:</div>

                <div class="input-field @error('email') is-invalid @enderror">
                    <label for="email">Email</label>
                    @error('email')
                    <label class="alert">ошибка</label>
                    @enderror
                    <input id="email"
                           name="email"
                           type="email"
                           placeholder="a.stepan-123@mail.ru"
                           value="{{ old('email') }}"
                           oninput="fnSaveToLocalStorage(this.id)"
                    >
                </div>

                <div class="input-field @error('phone') is-invalid @enderror">
                    <label for="phone">Телефон</label>
                    @error('phone')
                    <label class="alert">ошибка</label>
                    @enderror
                    <input
                        placeholder="89876543210"
                        id="phone"
                        name="phone"
                        class="@error('phone') is-invalid @enderror"
                        value="{{ old('phone') }}"
                        oninput="fnSaveToLocalStorage(this.id)"
                    >
                </div>

                <div>
                    <input
                        {{ old('isSocial') === 'on' ? 'checked' : '' }}
                        id="isSocial"
                        name="isSocial"
                        type="checkbox"
                        onchange="fnChangeSocial()"
                    >
                    <label for="isSocial">Я хочу получить скидку 60 рублей</label>
                    <p class="hint">Сумма вашего платежа составит 420 рублей в том случае, если Вы опубликуете пост про нас в своей соцсети. Ниже укажите адрес своего аккаунта в соцсети:</p>
                </div>

                <div class="input-field @error('social') is-invalid @enderror">
                    <label for="social">Адрес аккаунта:</label>
                    @error('social')
                    <label for="social" class="alert">ошибка</label>
                    @enderror
                    <input
                        placeholder="instagram.com/kinoru61"
                        id="social" name="social"
                        class="@error('social') is-invalid @enderror"
                        value="{{ old('social') }}"
                        oninput="fnSaveToLocalStorage(this.id)"
                    >
                </div>


                <div class="mt-50">Сумма Вашего заказа составит <span id="summ">480</span> рублей, и в неё входят:
                    <ul>
                        <li>Открытка (
                            @if ($color === 'dark')
                                тёмный вариант
                            @else
                                светлый вариант
                            @endif
                            ).</li>
                        <li>Заполнение открытки каллиграфом.</li>
                        <li>Отправка открытки Почтой России по заявленному адресу.</li>
                    </ul>
                </div>

                <div class="send-holder">
                    <input type="submit" value="Заказать">
                </div>
            </form>
        </main>

@endsection
