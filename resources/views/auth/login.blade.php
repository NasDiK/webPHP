@extends('layouts.main')

@section('title')
    Авторизация
@endsection
@section('content')
    <div class="row row--nogutter top-line">
        <div class="line"></div>
    </div>
    <div class="main">
        <div class="row">
            <div class="row--small">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <h2>Форма авторизации</h2>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Пароль</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" style="width: 10px;"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Запомнить меня?') }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn">Войти</button>
                        <a class="btn btn-link" href="{{ route('register') }}" style="text-decoration: none;">
                            {{ __('Регистрация') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
