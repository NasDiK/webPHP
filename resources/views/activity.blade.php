@extends('layouts.main')

@section('alert')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
@endsection

@section('content')
    <div class="hover"></div>
    <div class="title">{{ $activity->name }}</div>
    <div class="myRow grid between" style="padding: 0 52px;">

        <div class="content">
            <img width="200" height="150" style="margin-right: 10px;" src="../storage/photos/{{ $activity->image }}"
                 alt="{{ $activity->name }}">

            {{ $activity->description }}

        </div>
        <ul class="menu" style="height: min-content;">
            <li><a href="{{ route('activity', ['name' => 'Архитектурное моделирование']) }}">Архитектурное
                    моделирование</a></li>
            <li><a href="{{ route('activity', ['name' => 'Кулинария']) }}">Кулинария</a></li>
            <li><a href="{{ route('activity', ['name' => 'Резьба по дереву']) }}">Резьба по дереву</a></li>
            @if(isset(Auth::user()->roleName) && Auth::user()->roleName === 'MASTER' ?? false)
                <b>
                    <li><a href="{{ route('profile') }}">Профиль</a></li>
                </b>
            @endif
        </ul>
    </div>

    <div class="row shedule">
        <div class="row--small">
            <h2>Расписание</h2>
            <div class="drivers">
                @if($activity->master_classes)
                    @foreach ($master_classes as $masterClass)
                        <div class="driver grid">
                            <div class="driver-left grid">
                                <div class="driver-photo">
                                    <img width="122" height="122" style="   border-radius: 50%;"
                                         src="../storage/{{ $masterClass->creator->image }}">
                                </div>
                                <div class="driver-text" style="min-width: 625px;">
                                    <div class="driver-name">{{ $masterClass->creator->name }}</div>
                                    <div class="driver-desc"> {{ $masterClass->description }}</div>
                                </div>
                            </div>
                            <div class="driver-right">
                                @guest
                                @else
                                    @if($masterClass->hasRecord)
                                        <h1 class="driver-time" style="font-size: 16px;">
                                            Вы записаны
                                        </h1>
                                    @elseif(Auth::user()->id === $masterClass->creatorId)
                                        <h1 class="driver-time" style="font-size: 16px;">
                                            Вы автор
                                        </h1>
                                    @elseif($masterClass->canRegister)
                                        <form id="register-form"
                                              action="{{ route('registration', ['id' => $masterClass->id ]) }}"
                                              style="width: auto">
                                            @csrf
                                            <button class="driver-btn" type="submit">Записаться</button>
                                        </form>
                                    @else
                                        <h1 class="driver-time" style="font-size: 16px;">
                                            Мест нет
                                        </h1>
                                    @endif
                                @endguest
                                <div style="width: 150px;" class="driver-time">{{ $masterClass->startAtLocale }}</div>
                                <div style="width: 150px; margin-top: 8px;" class="driver-time">
                                    Стоимость: {{ $masterClass->cost }}</div>
                                @if($masterClass->emptySlots > 0)
                                    <div style="width: 150px; margin-top: 8px;" class="driver-time">Свободных
                                        мест: {{ $masterClass->emptySlots }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Пока нет мастер классов для данного вида творчества</p>
                @endif
            </div>
        </div>
@endsection
