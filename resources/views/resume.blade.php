<head>
  <link rel=stylesheet href="{{ asset('style.css') }}" type='text/css'>
  <title>Резюме и вакансии </title>
</head>

<body>

  <div class="header"><!--*****************Логотип и шапка********************-->
      Резюме и вакансии
      <div id="logo"></div>
  </div>
  <div class="leftcol"><!--**************Основное содержание страницы************-->


      <div class="pinline1">
          <img class="pic" src="{{ asset('storage/photos/' . $userData->Image) }}">
      </div>

      <p class="pinline second">
          {{$userData->FIO}}

          <br>
          Телефон: {{$userData->Phone}}
      </p>

      <p class="pinline third">
          {{$userData->staff->staff}}
          <br>

          Стаж: {{$userData->Stage}}
      </p>
  </div>

  <div class="rightcol"><!--*******************Навигационное меню*******************-->
      <ul class="menu">
          <li><a href="/">Главная страница</a></li>
          <li><a href="/resume/add">Добавить резюме</a></li>
      </ul>
  </div>
  <div class="footer">&copy; Copyright 2023</div>

</body>

</html>