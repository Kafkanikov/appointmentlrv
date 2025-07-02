@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-center bg-success text-white">
                    <h3 class="my-3">{{ __('Create Account') }}</h3>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your Name">
                            <label for="name"><i class="bi bi-person me-2"></i>{{ __('Name') }}</label>
                             @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="name@example.com">
                            <label for="email"><i class="bi bi-envelope me-2"></i>{{ __('Email Address') }}</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                            <label for="password"><i class="bi bi-lock me-2"></i>{{ __('Password') }}</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            <label for="password-confirm"><i class="bi bi-lock-fill me-2"></i>{{ __('Confirm Password') }}</label>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success btn-lg">{{ __('Register') }}</button>
                        </div>
                    </form>
                </div>
                 <div class="card-footer text-center py-3">
                    <a class="small" href="{{ route('login') }}">Have an account? Go to login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection