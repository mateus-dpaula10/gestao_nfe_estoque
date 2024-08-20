@extends('layouts.app')

@section('content')
    <h2 class="mb-5">Gestão Estoque e Nfe</h2>
    <h4 class="mb-3">{{ __('Login') }}</h4>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-row">

            <div class="form-group mb-3">
                <label for="email" class="form-label">{{ __('E-mail') }}</label>

                <div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">{{ __('Senha') }}</label>

                <div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary w-100 mt-5">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link mt-3 mx-auto d-block" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </form>
@endsection
