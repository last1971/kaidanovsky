@extends('layout')

@section('header')
    <style>
        #dotes {
            display: inline-block;
            width: 30px;
        }
        footer {
            display: none;
        }
        body{
            flex-flow: column nowrap;
            justify-content: center;
            align-content: center;
        }
        main > div {
            text-align: center;
            font-weight: 900;
        }
    </style>
    <script>
        function fnOnload() {
            setInterval(() => {
                const dotes = document.getElementById('dotes')
                if (dotes.innerText === '...') {
                    dotes.innerText = '';
                } else {
                    dotes.innerText += '.';
                }
            }, 500);
        }
    </script>
@endsection

@section('content')
    <main>
        <div>СКОРО ОТКРЫРТИЕ<span id="dotes"></span></div>
    </main>
@endsection
