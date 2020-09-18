<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="./img/mars.png">
        <link rel="icon" href="../img/mars.png">
        <title>Inversiones y Construcciones Suramérica</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet">
        <link rel="icon" href="./img/mars.png">
        <link rel="icon" href="../img/mars.png">


        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body{
                font-family: 'Roboto', serif;
            }
            .widget-login-bg{
                background-image: url('./img/login-cover.jpg');
                background-position: center center;
                background-size: cover;   
            }

            .widget-login-bg2{
                background-image: url('../img/login-cover.jpg');
                background-position: center center;
                background-size: cover;   
            }
            
            .widget-login-bg3{
                background-image: url('{{ asset('img/login-cover.jpg')}}');
                background-position: center center;
                background-size: cover;   
            }

            .heading-footer 
             { 
             background-image: url(./img/logo-login.png); 
             background-size: cover; 
             height: 175px; 
             -webkit-box-shadow: none; 
             box-shadow: none; 
             border: 0px; 
             border-radius: 0px; 
             }

            #logo_system{
             font-family: 'Monoton', cursive;
             /* font-weight: bold; */
            }
            .orange{
                background-color: #ff3000;
                color: white;
            }
            .dark-grey{
                background-color: #121212;
                color: white;
            } 
            .dark-grey:focus{
                background-color: #121212;
                color: white;
            }     
        </style>
    </head>
    <body class="widget-login-bg widget-login-bg2 widget-login-bg3">
        <div id="app">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>
