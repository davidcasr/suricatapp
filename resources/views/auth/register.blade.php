@extends('auth.layout')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group row">
        
        <div class="col-md-12">
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('name') }}" required autocomplete="username" autofocus placeholder="{{ __('Nombre de usuario') }}">

            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        
        <div class="col-md-12">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Correo electrónico') }}">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        
        <div class="col-md-12">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Contraseña') }}">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">

        <div class="col-md-12">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirmar contraseña') }}">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-lg">
                {{ __('Registro') }}
            </button>
        </div>
    </div>
</form>

@endsection
