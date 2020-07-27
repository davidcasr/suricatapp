<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="msapplication-tap-highlight" content="no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title> 
    
    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700|Rubik:400,600,700" rel="stylesheet">
    
    <style>
        body {
            font-family: "Rubik", sans-serif;
        }
        .app-login-box h4 {
            margin-bottom: 1.5rem;
            font-weight: normal;
        }
        .app-login-box h4 div {
            opacity: .6;
        }
        .app-login-box h4 span {
            font-size: 1.1rem;
        }
    </style>

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('images/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('images/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    
    <style>
        .bg{
            background: url(../images/suricata.png);
            background-size: cover;
            position: relative;
        }
       .bg-suricatapp {
            background: linear-gradient(135deg, #2f1ce0 0%, #53a0fd 30%, #51eca5 100%);
            opacity: .87;
       }
    </style>
</head>
<body>
    <div id="app">
       <div class="app-container app-theme-white body-tabs-shadow">
           <div class="app-container bg">
            <div class="h-100 bg-suricatapp bg-animation">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="modal-dialog w-100 mx-auto">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="h5 modal-title text-center">
                                        <h2><img src="{{ asset('images/logo-inverse-24x.png') }}" alt="" class="img-fluid b-logo"></h2>
                                        <h4 class="mt-2">
                                            <span>Gestiona y guía tu comunidad</span>
                                        </h4>
                                    </div>
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">Suricatapp © 2020 Reservados todos los derechos | Made with ❤️ by @davidcasr</div>
                    </div>
                </div>
            </div>
            </div>

       </div>
    </div>
    
    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

</body>
</html>