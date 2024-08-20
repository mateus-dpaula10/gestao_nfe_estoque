@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <h2 class="mb-5">Gestão Estoque e Nfe</h2>
    <h4 class="mb-3">{{ __('Reset Password') }}</h4>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-row">

            <div class="form-group mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>

                <div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary w-100 mt-5">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </div>
        
        </div>
    </form>
@endsection
