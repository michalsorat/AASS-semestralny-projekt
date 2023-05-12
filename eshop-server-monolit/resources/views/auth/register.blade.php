@extends('layouts.app')

@section('content')
<div class="auth-holder section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <div class="auth-form">
                    <div class="title">
                        <h4>Nemáte účet? Zaregistrujte sa.</h4>
                        <p>Registrácia trvá menej ako minútu a vďaka nej si uľahčíte proces objednávky</p>
                    </div>
                    <form class="row" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="auth-param col-sm-6">
                            <div class="form-group">
                                <label for="name">Meno</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" required>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="auth-param col-sm-6">
                            <div class="form-group">
                                <label for="last-name">Priezvisko</label>
                                <input class="form-control @error('last-name') is-invalid @enderror" type="text" id="last-name" name="last-name" required>

                                @error('last-name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
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
                        <div class="auth-param col-sm-6">
                            <div class="form-group">
                                <label for="street">Ulica</label>
                                <input class="form-control" type="text" id="street" name="street" required>
                            </div>
                        </div>
                        <div class="auth-param col-sm-6">
                            <div class="form-group">
                                <label for="street-nr">Orientačné číslo</label>
                                <input class="form-control @error('street-nr') is-invalid @enderror" type="text" id="street-nr" name="street-nr" required>
                            </div>

                            @error('street-nr')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="auth-param col-sm-6">
                            <div class="form-group">
                                <label for="city">Mesto</label>
                                <input class="form-control" type="text" id="city" name="city" required>
                            </div>
                        </div>
                        <div class="auth-param col-sm-6">
                            <div class="form-group">
                                <label for="psc">PSČ</label>
                                <input class="form-control" type="text" id="psc" name="psc" required>
                            </div>
                        </div>
                        <div class="auth-param col-sm-6">
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
                        <div class="auth-param col-sm-6">
                            <div class="form-group">
                                <label for="password-confirm">Heslo znova</label>
                                <input class="form-control" type="password" id="password-confirm" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="auth-button">
                            <button class="auth-btn btn btn-dark" type="submit">Registrovať</button>
                        </div>
                        <p class="outer-link">Už máte účet? <a href="{{ route('login') }}">Prihlásiť sa</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
