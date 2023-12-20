@extends('layouts.main')

@section('header')
    <h1>Добавить курс</h1>
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <section>
        <div class="row">
            <section class="eight columns">
                <form method="post" action="{{ route('storeCourse') }}" class="formContent" enctype="multipart/form-data">
                    @csrf
                    <p>Название <input name="title" class="form-control @error('title') is-invalid @enderror" type="text" value="{{old('title')}}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <p>Описание <textarea name="description" style="font-size: 16px;" class="form-control @error('description') is-invalid @enderror" type="text" rows="4" cols="50">{{old('description')}}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <p>Дата и время начала <input name="startAt" style="font-size: 16px;" class="form-control @error('startAt') is-invalid @enderror" type="datetime-local" value="{{old('startAt')}}">
                    @error('startAt')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <p>Фото <input name="image" style="font-size: 16px;" class="form-control @error('image') is-invalid @enderror" type="file" value="{{old('image')}}">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <p>Количество участников <input name="limit" class="form-control @error('limit') is-invalid @enderror" type="number" min="0" value="{{old('limit')}}">
                    @error('limit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <p>Язык <select class="form-select" style="font-size: 16px;" class="form-control @error('languageGroupId') is-invalid @enderror" name="languageGroupId">
                            <option selected disabled hidden="">Выбрать</option>
                            @foreach ($groups as $language)
                                @if (old('languageGroupId') == $language->id)
                                    <option value="{{$language->id}}" selected>{{$language->name}}</option>
                                @else
                                    <option value="{{$language->id}}">{{$language->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    @error('languageGroupId')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <p><input type="submit" value="Добавить курс" />
                </form>
            </section>
        </div>
    </section>
@endsection


