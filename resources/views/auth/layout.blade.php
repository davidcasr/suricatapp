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
    <style>
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
</head>
<body>
    <div id="app">
       <div class="app-container app-theme-white body-tabs-shadow">
           <div class="app-container">
            <div class="h-100 bg-plum-plate bg-animation">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="modal-dialog w-100 mx-auto">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="h5 modal-title text-center">
                                        <h4 class="mt-2">
                                            <div>Suricatapp</div>
                                            <span>Gestiona y guía tu comunidad</span>
                                        </h4>
                                    </div>
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">Copyright © Suricatapp 2020</div>
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