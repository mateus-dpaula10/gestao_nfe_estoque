@extends('layouts.app')

@section('content')
    <h2 class="mb-5">Gestão Estoque e Nfe</h2>
    <h4 class="mb-3">{{ __('Reset Password') }}</h4>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-row">

            <div class="form-group mb-3">
                <label class="form-label" for="email">{{ __('Email Address') }}</label>

                <div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="password">{{ __('Password') }}</label>

                <div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>

                <div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary w-100 mt-5">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>

        </div>
    </form>                
@endsection
