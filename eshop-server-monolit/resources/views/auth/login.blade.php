@extends('layouts.app')

@section('content')
<div class="auth-holder section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <div class="auth-form">
                    <div class="title">
                        <h4>Prihlásenie</h4>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="auth-param col-12">
                            <div class="form-group">
                                <label for="email">E-mailová adresa</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" required>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="auth-param col-12">
                            <div class="form-group">
                                <label for="password">Heslo</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" required>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

{{--                            <div class="form-group row">--}}
{{--                                <div class="col-md-6 offset-md-4">--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                        <label class="form-check-label" for="remember">--}}
{{--                                            {{ __('Remember Me') }}--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        <button class="auth-btn btn btn-dark" type="submit">Prihlásiť sa</button>
                        <p class="outer-link">Ešte nemáte účet? <a href="{{ route('register') }}">Zaregistrujte sa</a></p>

{{--                                    @if (Route::has('password.request'))--}}
{{--                                        <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                            {{ __('Forgot Your Password?') }}--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
