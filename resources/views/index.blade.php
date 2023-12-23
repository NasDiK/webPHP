@extends('layouts.main')

@section('content')
    <div class="hover"></div>
    <div class="title">«ОчУмелые ручки»</div>
    <div class="myRow grid between" style="padding: 0 52px;">

        {{-- TODO  --}}
        <div class="content">
            <img width="200" height="150" style="margin-right: 10px;" src="img/sidorovich-shablon.jpg">

            <p>Короче, Меченый!</p>

            <p>
                я тебя спас и в благородство играть не буду: выполнишь для меня пару заданий — и мы в расчете.
            </p>

            <p>Заодно посмотрим, как быстро у тебя башка после амнезии прояснится. А по твоей теме постараюсь разузнать. Хрен его знает, на кой ляд тебе этот Стрелок сдался, но я в чужие дела не лезу, хочешь убить, значит есть за что...</p>

            <p>
                <span>Наши курсы</span>
            </p>

            <p>1. Архитектурное моделирование:
            Обучение не только архитектуре, но и моделированию.</p>

            <p>2. Кулинария:
            Яичница на завтрак - это конечно хорошо, но вы пробовали поужинать жульеном?</p>

            <p> 3. Резьба по дереву:
            Создайте фигурки избранных персонажей любимой игры</p>

            <p>
                <span>Присоединяйтесь к нам</span>
            </p>

            <p>Присоединяйтесь к нашему сообществу творческих людей и начните свой удивительный путь в мире мастерства и искусства.
                Развивайтесь, творите и вдохновляйтесь вместе с нами!</p>

        </div>
        <ul class="menu" style="height: min-content;">
            <li><a href="{{ route('activity', ['name' => 'Архитектурное моделирование']) }}">Архитектурное моделирование</a></li>
            <li><a href="{{ route('activity', ['name' => 'Кулинария']) }}">Кулинария</a></li>
            <li><a href="{{ route('activity', ['name' => 'Резьба по дереву']) }}">Резьба по дереву</a></li>
            @if(isset(Auth::user()->roleName) && Auth::user()->roleName === 'MASTER' ?? false)
                <b><li><a href="{{ route('profile') }}">Профиль</a></li></b>
            @endif
        </ul>
    </div>

    @auth
    <div class="row shedule">
        <div class="row--small">
            <h2>Моё расписание</h2>
            <div class="drivers">
                @if(count($registrations ?? []) > 0)
                    @foreach ($registrations as $registration)
                        <div class="driver grid" style="gap: 20px;">
                            <div class="driver-right" style="display: flex; align-items: center;">
                                @guest
                                @else
                                    @if($registration->masterClass->hasRecord)
                                        <h1 class="driver-time" style="font-size: 16px;">
                                            Вы записаны
                                        </h1>
                                    @endif
                                @endguest
                                <div style="width: 150px;" class="driver-time">{{ $registration->masterClass->startAtLocale }}</div>
                            </div>
                            <div class="driver-left grid">
                                <div class="driver-text" style="min-width: 625px;">
                                    <div class="driver-name">{{ $registration->masterClass->name }}</div>
                                    <div class="driver-desc"> {{ $registration->masterClass->description }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Вы не записаны ни на один курс</p>
                @endif
            </div>
        </div>
    @endauth
@endsection
