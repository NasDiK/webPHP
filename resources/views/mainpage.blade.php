<html>

<head>
    <link rel=stylesheet href='style.css' type='text/css'>
    <title>{{$header}}</title>
</head>

<body>
    @extends('layout.master')

    @section('sidebar')
    @parent
    <ul class="menu">
        <li><a href="/resume/lab9/firstQuery">Первый запрос</a></li>
        <li><a href="/resume/lab9/secondQuery">Второй запрос</a></li>
        <li><a href="/resume/lab9/thirdQuery">Третий запрос</a></li>
        <li><a href="/resume/lab9/fourthQuery">Четвертый запрос</a></li>
        <li><a href="/resume/lab9/staffsList">Список профессий</a></li>
    </ul>
    @stop

    @section('content')
        @parent

    <div class="leftcol"><!--**************Основное содержание страницы************-->
        <h1>Программист</h1>

        @foreach($persons as $person)
        <div>
            <p class="pinline second">
                {{$person->FIO}}<br>
                Телефон: {{$person->Phone}}
            </p>
            <p class="pinline third">
                Стаж:
                {{$person->Stage}} лет
            </p>
            <form method="GET" action="{{ url("/resume/edit/$person->id") }}">
                <input type="submit" value="Изменить"/>
            </form>
            <form method="POST" action="{{ url("/resume/delete/$person->id") }}">
                @csrf
                <input type="submit" value="Удалить"/>
            </form>
            <form method="GET" action="{{ url("/resume/show/$person->id") }}">
                @csrf
                <input type="submit" value="Посмотреть"/>
            </form>
        </div>
        @endforeach
    </div>
    @stop
</body>

</html>