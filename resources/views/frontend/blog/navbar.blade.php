<nav class="navbar navbar-expand-lg fixed-top trans-navigation">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-24x.png') }}" alt="" class="img-fluid b-logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fa fa-bars"></i>
            </span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="mainNav">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link active smoth-scroll" href="{{ url('/') }}">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link smoth-scroll" href="{{ url('/'). '#service' }}">Características</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link smoth-scroll" href="{{ url('/').'#pricing' }}">Precios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link smoth-scroll" href="{{ url('/').'#blog' }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link smoth-scroll" href="{{ url('/').'#footer' }}">Contáctenos</a>
                </li>

                <li class="nav-item">
                @if (Route::has('login'))
                    @auth
                        <a class="nav-link smoth-scroll" href="{{ url('/dashboard') }}"><b>Dashboard</b></a>
                    @else
                        <a class="nav-link smoth-scroll" href="{{ route('login') }}"><b>Iniciar sesión</b></a>

                        @if (Route::has('register'))
                            <a class="nav-link smoth-scroll" href="{{ route('register') }}"><b>Registrar</b></a>
                        @endif
                    @endauth
                @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
