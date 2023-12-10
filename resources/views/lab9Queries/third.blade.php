@extends('layout.master')

@section('sidebar')
    @parent
    <li><a href="/resume/lab9/firstQuery">Первый запрос</a></li>
    <li><a href="/resume/lab9/secondQuery">Второй запрос</a></li>
    <li><a href="/resume/lab9/fourthQuery">Четвертый запрос</a></li>
    <li><a href="/resume/lab9/staffsList">Список профессий</a></li>
    @stop

@section('content')
    @parent
    <p> Количество {{$count}}
@stop