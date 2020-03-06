@extends('auth.layout')

@section('content')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="form-group row">

        <div class="col-md-12">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Correo electrónico') }}">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-lg">
                {{ __('Enviar enlace de restablecimiento de contraseña') }}
            </button>
        </div>
    </div>
</form>
@endsection
