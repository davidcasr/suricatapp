<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="http://davidcasr.co/">
        
        <title>Suricatapp</title>
        <!-- bootstrap.min css -->
        <link rel="stylesheet" href="{{ asset('frontend/plugins/bootstrap/css/bootstrap.css') }}">
        <!-- Icofont Css -->
        <link rel="stylesheet" href="{{ asset('frontend/plugins/fontawesome/css/all.css') }}">
        <!-- animate.css -->
        <link rel="stylesheet" href="{{ asset('frontend/plugins/animate-css/animate.css') }}">
        <!-- Icofont -->
        <link rel="stylesheet" href="{{ asset('frontend/plugins/icofont/icofont.css') }}">
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

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
    </head>

    <body data-spy="scroll" data-target=".fixed-top">

        @include('frontend.blog.navbar')

        <div class="page-banner-area page-contact" id="page-banner">
            <div class="overlay dark-overlay"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                        <div class="banner-content content-padding">
                            <h1 class="text-white">Blog</h1>
                            <p>Conoce nuestras últimas noticias, características y funcionalidades</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <section class="section blog-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <img src="images/blog/blog-lg.jpg" alt="" class="img-fluid">
                                    <div class="mt-4 mb-3 d-flex">
                                        <div class="post-author mr-3">
                                            <i class="fa fa-user"></i>
                                            <span class="h6 text-uppercase">Suricata</span>
                                        </div>

                                        <div class="post-info">
                                            <i class="fa fa-calendar-check"></i>
                                            <span>{{ $post->publish_date->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    
                                    <a href="#" class="h4 ">{{ $post->title }}</a>
                                    
                                    <p class="mt-3">{!! $post->body !!}</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </section>
              
        @include('frontend.footer')

        <!-- Main jQuery -->
        <script src="{{ asset('frontend/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4.3.1 -->
        <script src="{{ asset('frontend/plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('frontend/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- Woow animtaion -->
        <script src="{{ asset('frontend/plugins/counterup/wow.min.js') }}"></script>
        <script src="{{ asset('frontend/plugins/counterup/jquery.easing.1.3.js') }}"></script>
        <!-- Counterup -->
        <script src="{{ asset('frontend/plugins/counterup/jquery.waypoints.js') }}"></script>
        <script src="{{ asset('frontend/plugins/counterup/jquery.counterup.min.js') }}"></script>

        <script src="{{ asset('frontend/js/custom.js') }}"></script>

    </body>
  </html>