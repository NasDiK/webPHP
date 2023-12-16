@extends('layout.master')

@section('sidebar')
    @parent

    <li><a href="/resume/lab9/firstQuery">Первый запрос</a></li>
    <li><a href="/resume/lab9/secondQuery">Второй запрос</a></li>
    <li><a href="/resume/lab9/thirdQuery">Третий запрос</a></li>
    <li><a href="/resume/lab9/staffsList">Список профессий</a></li>

@stop

@section('content')
    @parent

    <table style="width: 50%">
      <tr style="border-bottom: 1px solid black">
        <td>&nbsp;</td>
        <td>Id</td>
        <td>Должность</td>
      </tr>
      @foreach ($Staffs as $staff)

        <tr>
          <td>&nbsp;</td>
          <td>{{ $staff->id }}</td>
          <td>{{ $staff->staff }}</td>
        </tr>

      @endforeach
    </table>
@stop