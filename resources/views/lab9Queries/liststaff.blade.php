@extends('layout.master')

@section('sidebar')
    @parent

    <li><a href="/resume/lab9/firstQuery">Первый запрос</a></li>
    <li><a href="/resume/lab9/secondQuery">Второй запрос</a></li>
    <li><a href="/resume/lab9/thirdQuery">Третий запрос</a></li>
    <li><a href="/resume/lab9/fourthQuery">Четвертый запрос</a></li>

@stop

@section('content')
    @parent

    <table style="width: 50%">
        <tr style="border-bottom: 1px solid black; font-weight: bold;">
          <td>Id</td>
          <td>Профессия</td>
        </tr>
        @foreach ($staffs as $staff)
  
          <tr>
            <td>{{ $staff->id }}</td>
            <td>{{ $staff->staff }}</td>
          </tr>
        @endforeach
      </table>
@stop