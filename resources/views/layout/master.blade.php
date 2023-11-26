<head>
  <link rel=stylesheet href='{{ asset('style.css') }}' type='text/css'>
  <title>Резюме и вакансии</title>
</head>

<body>

  @section('header')
      <div class="header">
          Резюме и вакансии
          <div id="logo"></div>
      </div>
  @show

  <div class="rightcol">
      <ul class="menu">
          <li><a href="{{ route('index') }}">Главная страница</a></li>
          <li><a href="{{ route('resumeAdd') }}">Добавить резюме</a></li>
          @yield('sidebar')
      </ul>
  </div>

  <div class="leftcol">
      @yield('content')
  </div>

  @section('footer')
      <div class="footer">&copy; Copyright 2023</div>
  @show

</body>

</html>