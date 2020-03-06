@extends('auth.layout')

@section('content')

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div class="form-group row">

        <div class="col-md-12">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12 text-center">

            @if (Route::has('password.request'))
                <a class="btn btn-link btn-lg" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif

            <button type="submit" class="btn btn-primary btn-lg">
                {{ __('Confirm Password') }}
            </button>
        </div>
    </div>
</form>

@endsection
