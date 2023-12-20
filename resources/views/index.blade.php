@extends('layouts.main')

@section('header')
    <h1>Языковая школа LINGVO</h1>

    <div style="display: flex; gap: 30px;">
        <label style="font-size: 16px; display: flex; align-items: center; gap: 10px;">
            Активный курс
            <input type="checkbox" value="active" class="active-input">
        </label>
        <label style="font-size: 16px; display: flex; align-items: center; gap: 10px;">
            Завершенный курс
            <input type="checkbox" value="ended" class="ended-input">
        </label>
        <label style="font-size: 16px; display: flex; align-items: center; gap: 10px;">
            Мест нет
            <input type="checkbox" value="full" class="full-input">
        </label>
    </div>
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <section>
        <div class="row">
            <section class="eight columns" style="min-height: 400px;">
                @foreach ($courses as $course)
                    <article class="blog_post">

                        <div class="three columns">
                            <a href="{{ route('course', ['id' => $course->id]) }}" class="th"><img src="storage/{{ $course->image }}" alt="desc" /></a>
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

@section('js')
    <script>
        $(document).ready( function () {
            $('.active-input, .ended-input, .full-input').change(function () {
                const active = $('.active-input').is(':checked');
                const ended = $('.ended-input').is(':checked');
                const full = $('.full-input').is(':checked');

                console.log({active, ended, full})

                $.ajax({
                    url: "{{ route('list') }}",
                    type: 'GET',
                    data: {
                        active: active,
                        ended: ended,
                        full: full
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (response) => {
                        $('.eight').html(response);
                    }
                })
            })
        })
    </script>
@endsection


