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
        .agreement{
            border: solid 1px transparent;;
            border-radius: 6px;
            margin: 5px;
            padding: 5px;
            display: grid;
            grid-template-columns: 50px auto;
            gap: 10px;
        }
        .agreement .agreement-text {
            font-size: 0.9em !important;
        }
        .agreement .agreement-text label {
            font-weight: 900;
        }
        .agreement-input {
            text-align: center;
        }
        .agreement.is-invalid {
            border: solid 1px red;
        }
    </style>
    <script>
        function fnChangeAgreement(val){
            document.getElementById('agree').value = val ? 'true' : 'false';
        }
        function fnChange(element) {
            const input = element.parentElement.querySelector('input,textarea');
            const counter = element.parentElement.querySelector('.counter');
            const len = input.value.length
            const max = input.getAttribute('maxlength');
            counter.innerHTML = `${len} / ${max}`;
            fnSaveToLocalStorage(element.id);
        }
        function fnOnload(){
            if ('{{ old('agree') }}' === 'false') {
                document.getElementById('agreement').checked = false;
            }

            if (localStorage.getItem('name') && !'{{ old('name') }}') {
                document.getElementById('name').value = localStorage.getItem('name');
            }

            if (localStorage.getItem('payerName') && !'{{ old('payerName') }}') {
                document.getElementById('payerName').value = localStorage.getItem('payerName');
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

            if (localStorage.getItem('customFrom') != null && !'{{ old('customFrom') }}' && localStorage.getItem('customFrom') === 'true') {
                document.getElementById('customFrom').checked = true;
            }

            if (localStorage.getItem('isCustomText') != null && !'{{ old('isCustomText') }}' && localStorage.getItem('isCustomText') === 'true') {
                document.getElementById('isCustomText').checked = true;
            }

            if (localStorage.getItem('isSocial') != null && !'{{ old('isSocial') }}' && localStorage.getItem('isSocial') === 'true') {
                document.getElementById('isSocial').checked = true;
            }

            document.getElementById('fromName').setAttribute('data-default', '???????????????? K-INO.RU');
            document.getElementById('fromName').setAttribute('data-custom', '{{ old('fromName') }}');
            if (document.getElementById('customFrom').checked) {
                document.getElementById('fromName').value = '{{ old('fromName') }}' || localStorage.getItem('fromName');
            } else {
                document.getElementById('fromName').value = document.getElementById('fromName').getAttribute('data-default');
                document.getElementById('fromName').setAttribute('readonly', 'readonly');
            }

            document.getElementById('fromAddress').setAttribute('data-default', '??. ????????????-????-????????, ??/?? 5560');
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

            document.getElementById('customText').setAttribute('data-default', '?????????? ???????????????????? ????, ?????? ????????????????!');
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
                <a href="{{ $color === 'dark' ? route('dark') : route('light') }}">??????????</a>
                <span></span>
                <span>

                </span>
            </div>
            @if ($color === 'dark')
                <img class="img-thumb"  alt="???????????? ??????????????" src="/img/kaydanovsky_2_big.jpg">
            @else
                <img class="img-thumb"  alt="?????????????? ??????????????" src="/img/kaydanovsky_1_big.jpg">
            @endif
        </div>

        <main>
            <form autocomplete="off" method="POST" action="{{ route('create') }}">
                @csrf
                <div>
                    <span>???? ??????????????</span>
                    <label for="color">
                        @if ($color === 'dark')
                            ???????????? ????????????????
                        @else
                            ?????????????? ????????????????
                        @endif
                    </label>
                    <input id="color" name="color" value="{{ $color }}" hidden>
                </div>
                <div class="mt-50">??????????????????, ????????????????????, ?????????? ????????????. ?????????????????? ???????? ???????????????? ??????, ?????? ???? ???? ???????????????? ???? ???? ???????????????? ???????????????? ?????? ????????????????:</div>

                <div class="input-field @error('name') is-invalid @enderror">
                    <label for="name">????????</label>
                    @error('name')
                    <label for="name" class="alert">????????????</label>
                    @enderror
                    <input
                        placeholder="?????????????????? ??????????????"
                        id="name"
                        name="name"
                        class="@error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        oninput="fnSaveToLocalStorage(this.id)"
                    >
                </div>

                <div class="input-field @error('address') is-invalid @enderror">
                    <label for="address">????????</label>
                    @error('address')
                    <label class="alert">????????????</label>
                    @enderror
                    <textarea
                        maxlength="255"
                        id="address"
                        placeholder="????. ????????????, ??.20, ????.29,
??.??????????????????????, ?????????????? ??-????,
?????????????????????????? ??????.
"
                        name="address"
                        class="@error('address') is-invalid @enderror"
                        oninput="fnChange(this)"
                    >{{ old('address') }}</textarea>
                    <label class="counter"></label>
                </div>

                <div class="input-field @error('index') is-invalid @enderror">
                    <label for="index">???????????? ?????????? ????????????????????</label>
                    @error('index')
                    <label class="alert">????????????</label>
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
                    <label for="customFrom">?? ???????? ?????????????? ?????????????? ??????????????????????</label>
                    <p class="hint">???? ?????????????????? ???? ???????????????????? ???????????????? ???? ?????????????????? K-INO.RU, ???? ???? ???????????? ?????????????? ???????? ?? ???????????????? ??????????????????????, ???????????????? ?????????????? ????????</p>
                </div>

                <div class="input-field @error('fromName') is-invalid @enderror">
                    <label for="fromName">???? ????????</label>
                    @error('fromName')
                    <label for="fromName" class="alert">????????????</label>
                    @enderror
                    <input
                        placeholder="?????????????? ????????????????????????"
                        id="fromName" name="fromName"
                        class="@error('fromName') is-invalid @enderror"
                        oninput="fnSaveToLocalStorage(this.id)"
                    >
                </div>

                <div class="input-field @error('fromAddress') is-invalid @enderror">
                    <label for="fromAddress">????????????</label>
                    @error('fromAddress')
                    <label class="alert">????????????</label>
                    @enderror
                    <textarea
                        id="fromAddress"
                        placeholder="??????. ????????????????, ??.12,
??. ????????????-????-????????
"
                        name="fromAddress"
                        class="@error('fromAddress') is-invalid @enderror"
                        maxlength="255"
                        oninput="fnChange(this)"
                    ></textarea>
                    <label class="counter"></label>
                </div>

                <div class="input-field @error('fromIndex') is-invalid @enderror">
                    <label for="fromIndex">???????????? ?????????? ??????????????????????</label>
                    @error('fromIndex')
                    <label class="alert">????????????</label>
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
                    <label for="isCustomText">?? ???????? ?????????????? ???????? ??????????</label>
                    <p class="hint">???? ?????????????????? ???? ???????????????????? ???????????????? ?? ?????????????? "<span id="prevCustomText">?????????? ???????????????????? ????, ?????? ????????????????!</span>", ???? ???? ???????????? ?????????????? ?????????????????????? ?????????????? ????????????, ???????????????? ?????????????? ????????</p>
                </div>

                <div class="input-field @error('customText') is-invalid @enderror">
                    <label for="customText">?????????? ????????????????</label>
                    @error('customText')
                    <label class="alert">????????????</label>
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


                <div class="mt-50">?????????????? ???????????????????? ?????????????????? ??????????????????????:</div>

                <div class="input-field @error('payerName') is-invalid @enderror">
                    <label for="payerName">??????</label>
                    @error('payerName')
                    <label for="payerName" class="alert">????????????</label>
                    @enderror
                    <input
                        placeholder="???????????????? ???????????? ??????????????"
                        id="payerName"
                        name="payerName"
                        class="@error('payerName') is-invalid @enderror"
                        value="{{ old('payerName') }}"
                        oninput="fnSaveToLocalStorage(this.id)"
                    >
                </div>

                <div class="input-field @error('email') is-invalid @enderror">
                    <label for="email">Email</label>
                    @error('email')
                    <label class="alert">????????????</label>
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
                    <label for="phone">??????????????</label>
                    @error('phone')
                    <label class="alert">????????????</label>
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
                    <label for="isSocial">?? ???????? ???????????????? ???????????? 60 ????????????</label>
                    <p class="hint">?????????? ???????????? ?????????????? ???????????????? 420 ???????????? ?? ?????? ????????????, ???????? ???? ?????????????????????? ???????? ?????? ?????? ?? ?????????? ??????????????. ???????? ?????????????? ?????????? ???????????? ???????????????? ?? ??????????????:</p>
                </div>

                <div class="input-field @error('social') is-invalid @enderror">
                    <label for="social">?????????? ????????????????:</label>
                    @error('social')
                    <label for="social" class="alert">????????????</label>
                    @enderror
                    <input
                        placeholder="instagram.com/kinoru61"
                        id="social" name="social"
                        class="@error('social') is-invalid @enderror"
                        value="{{ old('social') }}"
                        oninput="fnSaveToLocalStorage(this.id)"
                    >
                </div>


                <div class="mt-50">?????????? ???????????? ???????????? ???????????????? <span id="summ">480</span> ????????????, ?? ?? ?????? ????????????:
                    <ul>
                        <li>???????????????? (
                            @if ($color === 'dark')
                                ???????????? ??????????????
                            @else
                                ?????????????? ??????????????
                            @endif
                            ).</li>
                        <li>???????????????????? ???????????????? ??????????????????????.</li>
                        <li>???????????????? ???????????????? ???????????? ???????????? ???? ?????????????????????? ????????????.</li>
                    </ul>
                </div>

                <div class="agreement @error('agreement') is-invalid @enderror">
                    <div class="agreement-input">
                        <input
                            id="agreement"
                            name="agreement"
                            type="checkbox"
                            checked
                            onchange="fnChangeAgreement(this.checked)"
                        >
                        <input
                            id="agree"
                            name="agree"
                            value="{{ (old('agree') === 'true' || old('agree') === null) ? 'true' : 'false' }}"
                            type="hidden"
                        >
                    </div>
                    <div class="agreement-text">
                        ?? ?????????????? ?????????????????????????? ???????????????????? ???????? ?????????? ?? <a href="/privacy">?????????????? ????????????????</a> ???? ?????????????????? ???????? ???????????? ?? ?????????? ???????????????? ???????????????????? ???????? ???????????????? ????????????????.
                        @error('agreement')
                        <label for="agreement" class="alert">?????? ???????????? ???????????????? ???? ???? ?????????? ???????????? ????????????????????</label>
                        @enderror
                    </div>
                </div>

                <div class="send-holder">
                    <input type="submit" value="????????????????">
                </div>
            </form>
        </main>

@endsection
