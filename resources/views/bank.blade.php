@extends('layout')

@section('header')
    <style>
        main {
            height: auto;
            min-height: calc(100% - 350px);
        }
    </style>
    <script>
        function fnOnload() {
        }
    </script>
@endsection

@section('content')
    <div class="prev-next">
        <div>
            <a href="javascript:history.go(-1)">назад</a>
            <span></span>
            <span></span>
        </div>
    </div>
    <main>
        <h1>
            Индивидуальный предприниматель Миронюк Евгений Михайлович
        </h1>

        <div>
            ИНН 616508166144 <br>
            ОГРНИП 316619600055961 от 25.01.2016 г.<br><br>

            Банковские реквизиты:<br>
            Рас/сч. 40802810470310000582<br>
            БИК 044525092<br>
            Московский филиал АО КБ "Модульбанк"<br>
            Кор/сч. 30101810645250000092<br><br>

            Юридический адрес:<br>
            344016, г. Ростов-на-Дону, ул. Стрелковая, д. 59<br><br>

            Почтовый адрес:<br>
            344016, г. Ростов-на-Дону, а/я 5560<br><br>

            Контактная информация:<br>
            Телефон: +79185218017<br>
            E-mail: me@don.ru
        </div>

    </main>
@endsection
