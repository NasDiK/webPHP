@extends('layout.master')

@section('sidebar')
    @parent

    <li><a href="/resume/lab9/secondQuery">Второй запрос</a></li>
    <li><a href="/resume/lab9/thirdQuery">Третий запрос</a></li>
    <li><a href="/resume/lab9/fourthQuery">Четвертый запрос</a></li>
    <li><a href="/resume/lab9/staffsList">Список профессий</a></li>
    @stop

@section('content')
    @parent

    <table style="width: 50%">
      <tr style="border-bottom: 1px solid black">
        <td>&nbsp;</td>
        <td>Id</td>
        <td>ФИО</td>
        <td>Стаж</td>
      </tr>
      @foreach ($Persons as $person)

        <tr>
          <td>&nbsp;</td>
          <td>{{ $person->id }}</td>
          <td>{{ $person->FIO }}</td>
          <td>{{ $person->Stage }}</td>
        </tr>

      @endforeach
    </table>
@stop