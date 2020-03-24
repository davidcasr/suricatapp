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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    
</head>
<body>
    <div id="app">
       <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('layouts.header')
            <div class="ui-theme-settings">  
                <div class="theme-settings__inner">
                    <div class="scrollbar-container">
                        <div class="theme-settings__options-wrapper"> 
                        </div>
                    </div>
                </div>
            </div>      
            <div class="app-main">
                @include('layouts.sidebar')  
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        @yield('content')
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
    @yield('scripts')
</body>
</html>
