@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h3 class="my-3">{{ __('Login') }}</h3>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
                            <label for="email"><i class="bi bi-envelope me-2"></i>{{ __('Email Address') }}</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                            <label for="password"><i class="bi bi-lock me-2"></i>{{ __('Password') }}</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">{{ __('Login') }}</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    @if (Route::has('password.request'))
                        <a class="small" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection