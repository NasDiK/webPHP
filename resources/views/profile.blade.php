@extends('layouts.main')

@section('content')
    <div class="hover"></div>
    <div class="title"></div>
    <div class="row--small grid between">
        <div class="content driver-page">
            <div class="driver-page-photo">
                <img height="200px;" width="200px;" src="../storage/{{ $user->image }}">
            </div>
            <div class="driver-page-name">{{ $user->name }}</div>
            <div class="driver-page-text">
                <div class="driver-page-my">Мои мастер-классы</div>
                <table class="driver-page-table">
                    <tbody>
                    @foreach ($master_classes as $masterClass)
                        <tr>
                            <td>{{ $masterClass->startAtLocale }}</td>
                            <td>
                                <b>
                                    <a style="text-decoration: none;"
                                      href="{{ route('masterClass', ['id' => $masterClass->id])  }}">
                                        {{ $masterClass->name }}
                                    </a>
                                </b>
                                @foreach ($masterClass->registrations as $registration)
                                    <p>
                                        {{ $loop->index + 1 }}. {{ $registration->user['name'] }} <br>
                                        email: {{ $registration->user['email'] }} <br>
                                        tel: {{ $registration->user['phone'] }}
                                    </p>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="driver-page-btn-wrapper">
                <a style="text-decoration: none;" href="{{ route('addMasterClass') }}">
                    <div class="driver-page-btn btn">
                       Добавить мастер-класс
                    </div>
                </a>
            </div>
        </div>
        <ul class="menu" style="height: 300px;">
            <li><a href="{{ route('activity', ['name' => 'Архитектурное моделирование']) }}">
                    Архитектурное моделирование</a></li>
            <li><a href="{{ route('activity', ['name' => 'Кулинария']) }}">Кулинария</a></li>
            <li><a href="{{ route('activity', ['name' => 'Резьба по дереву']) }}">Резьба по дереву</a></li>
        </ul>
    </div>
@endsection
