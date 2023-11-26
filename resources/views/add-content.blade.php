@extends('layout.master')

@section('sidebar')
  @parent
@stop

@php
  $personModel = isset($editPerson) ? [
    'id' => $editPerson->id, 
    'FIO' => $editPerson->FIO, 
    'Phone' => $editPerson->Phone, 
    'Image' => $editPerson->Image, 
    'Staff' => $editPerson->Staff,
    'Stage' => $editPerson->Stage 
  ] : [
    'FIO' => old('FIO'), 
    'Phone' => old('Phone'), 
    'Image' => old('Image'), 
    'Staff' => old('Staff'),
    'Stage' => old('Stage') 
  ];
@endphp

@section('content')
  @parent

  {{$addResult}}

  <form method="POST" action="{{ isset($editPerson) ? url('/resume/edit/'. $personModel['id']) : url('/resume/add') }}" class="formContent" enctype="multipart/form-data">
    @csrf
    <p>ФИО <input name="FIO" type="text" value="{{$personModel['FIO']}}">
    <p>Телефон <input name="Phone" value="{{$personModel['Phone']}}">
    <p>Фото <input name="Image" type="file" value="{{$personModel['Image']}}">

    <p>Профессия <select name="Staff">
      @foreach ($staffs as $staff)
        @if ($personModel['Staff'] == $staff->id)
        <option value="{{$staff->id}}" selected>{{$staff->staff}}</option>
        @else
          <option value="{{$staff->id}}">{{$staff->staff}}</option>
        @endif
      @endforeach
    </select>

    <p>Стаж <input name="Stage" type="number" value="{{$personModel['Stage']}}"/>
    <p><input type="submit" value="{{isset($editPerson) ? 'Изменить' : 'Добавить'}} резюме" />
  </form>
@stop