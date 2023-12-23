@extends('layouts.main')

@section('content')
    <div class="row row--nogutter top-line">
        <div class="line"></div>
    </div>
    <div class="myRow grid between" style="padding: 0 52px;">
        <form method="post" action="{{ route('updateMasterClass', ['id' => $masterClass->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h2>Форма добавления мастер-класса</h2>
            <div class="form-group">
                <label>Вид творчества</label>
                <select class="form-select" class="form-control @error('activityId') is-invalid @enderror"
                        name="activityId" disabled>
{{--                    @foreach ($activity as $active)--}}
{{--                        @if (old('activityId') == $active->id)--}}
{{--                            <option value="{{$active->id}}" selected>{{$active->name}}</option>--}}
{{--                        @else--}}
{{--                            <option value="{{$active->id}}">{{$active->name}}</option>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
                    <option value="{{$masterClass->activityId}}" selected>{{$masterClass->activity->name}}</option>--}}
                </select>
                @error('activityId')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Название мастер-класса</label>
                <input name="name"
                       class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $masterClass->name }}" disabled>
                @error('name')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Описание мастер-класса</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror">
                    {{ old('description') ?? $masterClass->description}}
                </textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Стоимость мастер-класса</label>
                <input min="1" name="cost" class="form-control @error('cost') is-invalid @enderror" type="number"
                       value="{{old('cost') ?? $masterClass->cost}}">
                @error('cost')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Дата</label>
                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                       value="{{ old('date') ?? $date }}" disabled>
                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Время</label>
                <input type="time" name="time" class="form-control @error('time') is-invalid @enderror"
                       value="{{ old('time') ?? $time }}" disabled>
                @error('time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Количество человек в группе</label>
                <input min="1" name="limit" class="form-control @error('limit') is-invalid @enderror" type="number"
                       value="{{ old('limit') ?? $masterClass->limit }}" disabled>
                @error('limit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Отправить">
            </div>
        </form>
    </div>
@endsection
