@extends('layouts.main')

@section('content')
    <div class="row row--nogutter top-line">
        <div class="line"></div>
    </div>
    <div class="myRow grid between" style="padding: 0 52px; flex-direction: column; width: 60%;">
            <h2 style=" margin-bottom: 10px;">Форма записи на мастер-класс {{ $masterClass->name }}</h2>
            <div class="form-group">
                <label>Вид творчества</label>
                <h6> {{ $masterClass->activity['name'] }} </h6>
            </div>
            <div class="form-group">
                <label>ФИО</label>
                <h6> {{ $user->name }} </h6>
            </div>
            <div class="form-group">
                <label>Мастер</label>
                <h6> {{ $masterClass->creator->name }} </h6>
            </div>
            <div class="form-group">
                <label>Дата</label>
                <h6> {{ $date }} </h6>
            </div>
            <div class="form-group">
                <label>Время</label>
                <h6> {{ $time }} </h6>
            </div>
        <div class="flex-row" style="display: flex; gap: 30px; margin-bottom: 20px;">
            <form method="post" action="{{ route('course-register', ['id' => $masterClass->id ]) }}" style="width: auto; margin: 0; padding: 0;">
                @csrf
                <input type="submit" class="btn" value="Записаться">
            </form>
            <a href="{{ route('activity', ['id' => $masterClass->activityId]) }}" style="width: 150px; margin: 0;">
                <button type="submit" class="btn" >Отмена</button>
            </a>
        </div>
    </div>
@endsection
