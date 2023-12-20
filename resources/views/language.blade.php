@extends('layouts.main')

@section('header')
    <h1>Языковая школа LINGVO</h1>
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <section>
        <div class="row">
            <section class="eight columns">

                <h3>{{$group->name}}</h3>

                @foreach ($group->courses as $course)
                    <article class="blog_post">

                        <div class="three columns">
                            <a href="{{ route('course', ['id' => $course->id]) }}" class="th"><img src="../storage/{{ $course->image }}" alt="desc" /></a>
                        </div>
                        <div class="nine columns">
                            <a href="{{ route('course', ['id' => $course->id]) }}"><h4>{{ $course->title }}</h4></a>
                            <p> {{ $course->description }}</p>

                            <div style="display: flex; gap: 15px;">
                                @if($role && !$course->hasMembers)
                                    <form id="delete-form" action="{{ route('deleteCourse', ['id' => $course->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Удалить</button>
                                    </form>
                                @endif

                                @if($course->hasEmptySpace && !$course->hasRecord && $course->notStarted)
                                    <form id="delete-form" action="{{ route('courseRegister', ['id' => $course->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit">Записаться на курс</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </section>

            @if($role === 'ADMIN')
                <section class="four columns">
                    <H3>  &nbsp; </H3>
                    <div class="panel">
                        <h3>Админ-панель</h3>
                        <ul class="accordion">
                            <li class="active">
                                <div class="title">
                                    <a href="{{ route('courseAdd') }}"><h5>Добавить курс</h5></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
            @endif
        </div>
    </section>
@endsection


