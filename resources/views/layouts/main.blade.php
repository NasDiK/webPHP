<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>

    <meta charset="utf-8" />
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width" />

    <title>Новости науки</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    <!-- Included CSS Files (Compressed) -->
    <link rel="stylesheet" href="{{ asset('css/foundation.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="{{ asset('js/modernizr.foundation.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('fonts/ligature.css') }}">


    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />

    <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    @yield('head')
</head>

<body>

<!-- ######################## Main Menu ######################## -->

<nav>

    <div class="twelve columns header_nav">
        <div class="row">

            <ul id="menu-header" class="nav-bar horizontal" style="height: 60px;">

                <li><a href="{{ route('index') }}">Главная</a></li>
                {{-- @todo Переделать на БД запрос --}}
                <li><a href="{{ route('rubric', ['id' => 1]) }}">Искусственный интеллект</a></li>
                <li><a href="{{ route('rubric', ['id' => 2]) }}">Искусственная нейронная сеть</a></li>
                <li><a href="{{ route('rubric', ['id' => 3]) }}">Распознавание образов</a></li>
                <li><a href="{{ route('rubric', ['id' => 4]) }}">Робототехника</a></li>
                <li><a href="{{ route('rubric', ['id' => 5]) }}">Информационное общество</a></li>
                <li><a href="{{ route('rubric', ['id' => 6]) }}">Автоматическая обработка текста</a></li>
                <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <b>Выйти</b></a></li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @yield('sidebar')
            </ul>

        </div>
    </div>

</nav><!-- END main menu -->

<!-- ######################## Header (featured posts) ######################## -->

    <header>
        <div class="row">
            @yield('header')
        </div>
    </header>

<!-- ######################## Section ######################## -->


    <section>
        <div class="section_main">
            @yield('content')
        </div>
    </section>


<!-- ######################## Section ######################## -->


@section('section')
<section>

    <div class="section_dark">
        <div class="row">

            <h2></h2>

            <div class="two columns">
                <img src="{{ asset('storage/photos/thumb1.jpg') }}" alt="desc" />
            </div>

            <div class="two columns">
                <img src="{{ asset('storage/photos/thumb2.jpg') }}" alt="desc" />
            </div>

            <div class="two columns">
                <img src="{{ asset('storage/photos/thumb3.jpg') }}" alt="desc" />
            </div>

            <div class="two columns">
                <img src="{{ asset('storage/photos/thumb4.jpg') }}" alt="desc" />
            </div>

            <div class="two columns">
                <img src="{{ asset('storage/photos/thumb5.jpg') }}" alt="desc" />
            </div>

            <div class="two columns">
                <img src="{{ asset('storage/photos/thumb6.jpg') }}" alt="desc" />
            </div>


        </div>
    </div>

</section>
@show


<!-- ######################## Footer ######################## -->

@section('footer')
    <footer>
        <div class="row">
            <div class="twelve columns footer">
                <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="twitter">Twitter</a>
                <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="facebook">Facebook</a>
                <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="pinterest">Pinterest</a>
                <a href="" class="lsf-icon" style="font-size:16px" title="instagram">Instagram</a>
            </div>

        </div>
    </footer>
@show

<!-- ######################## Scripts ######################## -->

<!-- Included JS Files (Compressed) -->
<script src="{{ asset('js/foundation.min.js') }}" type="text/javascript"></script>
<!-- Initialize JS Plugins -->
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
</body>
</html>