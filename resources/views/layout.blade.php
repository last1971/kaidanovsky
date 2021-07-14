<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="HandheldFriendly" content="True" />
    <meta name="format-detection" content="telephone=no">

    <meta name="Description" content="75 лет Александру Кайдановскому: получи памятную открытку с гашением печатью одного дня в любую точку мира.">
    <meta name="keywords" content="Ростов, Открытка Кайдановский, Памятная открытка Кайдановский, печать одного дня, Почта России Кайдановский, Кайдановский, 75 лет Кайдановскому, Свой среди чужих, Чужой среди своих, Сталкер">

    <meta property="og:site_name" content="DON.RU" />
    <meta property="og:title" content="75 лет Александру Кайдановскому">
    <meta property="og:description" content="75 лет Александру Кайдановскому: получи памятную открытку с гашением печатью одного дня в любую точку мира.">
    <meta property="og:image" content="http://don.ru/otkrytka_kaidanovsky_og.jpg" />
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://don.ru/" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="75 лет Александру Кайдановскому: получи памятную открытку с гашением печатью одного дня в любую точку мира." />
    <meta name="twitter:image" content="http://don.ru/img/otkrytka_kaidanovsky_og.jpg" />

    <meta property="fb:admins" content="100000432952509" />
    <title>75 лет Александру Кайдановскому</title>

    <link rel="icon" href="/favicon.svg">
    <link rel=”mask-icon” href=”/favicon.svg” color=”#000000">

    <title>75 лет Александру Кайдановскому</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;900&display=swap" rel="stylesheet">

    <style>
        html {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            width: 100%;
            min-height: 100%;
            font-family: 'Nunito', sans-serif;
            display: flex;
            flex-flow: column nowrap;
            justify-content: flex-start;
            align-items:center;
            margin: 0;
            padding: 0;
        }
        main {
            max-width: 1080px;
            flex: 0 1 auto;
            margin: 10px auto;
            width: calc(100% - 20px);
            padding: 0;
        }
        h1 {
            font-size: 30px;
        }
        h2 {
            font-size: 24px;
        }
        p {
            text-indent: 10px;
            margin: 5px 0 15px 0;
        }
        p, div {
            font-size: 18px;
            line-height: 20px;
        }
        a {
            color: black;
        }
        b {
            font-weight: 900;
        }
        .big-img {
            width: 85%;
            max-width: 600px;
            margin: 10px auto;
        }
        .big-img img {
            width: 100%;
            border-radius: 4px;
        }
        .prev-next {
            width: 100%;
            max-width: 1080px;
            height: 50px;
            margin-bottom: 20px;
            position: relative;
        }
        .prev-next div {
            margin: 10px;
            height: 100%;
            display: grid;
            grid-template-columns: 33% 34% 33%;
        }
        .prev-next a {
            text-decoration: none;
            text-align: center;
            border: solid 1px gray;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .mt-50 {
            margin-top: 50px;
        }
        *::placeholder {
            color: silver;
        }
        footer {
            width: 90%;
            max-width: 800px;
            margin: 50px auto 50px auto;
            height: 200px;
            padding: 30px 10px;
            display: flex;
        }
        footer > * {
            flex: 1 1 auto;
            border-top: solid 2px gray;
            padding-top: 20px;
        }
        footer .links {
            padding: 25px 5px 0 10px;
        }
        footer .links a {
            display: block;
            margin: 0 0 10px 10px;
        }
        footer .logo-kino {
            width: 100px;
            margin-left: 15px;
        }
        footer .logo-modul {
            margin-top: 30px;
            width: 130px;
        }
    </style>
    @yield('header')
    </head>
    <body onload="fnOnload()">
        @yield('content')
        <footer>
            <div>
                <a href="/">
                    <img class="logo-kino" src="/img/k-ino_logo_b.svg" alt="Лого K-INO.RU">
                </a><br>
                <a href="https://modulbank.ru/">
                    <img class="logo-modul" src="/img/Modulbank-logo-rgb.svg" alt="Лого MODULBANK">
                </a>

            </div>
            <div class="links">
                <a href="/oferta">Публичная оферта</a>
                <a href="/bank">Реквизиты</a>
                <a href="/privacy">Соглашение о персональных данных</a>
                <a href="tel:+79185218017">Телефон: +79185218017</a>
                <a href="mailto:me@don.ru">E-mail: me@don.ru</a>
            </div>
        </footer>
    </body>
</html>
