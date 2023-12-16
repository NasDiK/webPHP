<html>

<head>
    <link rel=stylesheet href='style.css' type='text/css'>
    <title>{{$header}}</title>
</head>

<body>
    @extends('layout.master')

    @section('sidebar')
    @parent
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