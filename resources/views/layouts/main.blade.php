<!DOCTYPE html>
<html>
<head>
    <title> @yield('title') </title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="header">
    <div class="myRow grid middle between">
        <div class="logo">
            <a href="{{ route('index') }}"><img src="{{ asset('img/logo.png') }}"></a>
        </div>
        <div class="title">
            Клуб любителей творчества «ОчУмелые ручки»
        </div>
        <div class="auth">
            @guest
                <a href="{{ route('login') }}">Вход</a>
            @else
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                    {{ __('Выйти') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>
    </div>
</div>
<div class="row row--nogutter">
    <div class="menu-burger">
        <div class="burger">
            <div>edfg</div>
            <div>dfg</div>
            <div>dsfg</div>
        </div>
    </div>
</div>
<div class="main">
    <div class="row">
        <div style="position: relative; right: 0; height: auto; z-index: 30; left: 75%; width: auto;">
            @yield('alert')
        </div>
        @yield('content')
    </div>
</div>
<div class="row row--nogutter">
    <div class="line"></div>
</div>
<div class="footer">
    <div class="row">
        <div class="row--small grid between">
            <div class="address">Наш адрес: Тюмень, Суходольская 16</div>
            <div class="tel">Тел: 89123456765</div>
            <div class="copy">(с) Copyright, 2023</div>
        </div>
    </div>
</div>
@yield('js')
</body>
</html>
