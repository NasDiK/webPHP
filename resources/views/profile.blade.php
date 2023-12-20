@extends('layouts.main')

@section('header')
    <div class="row">
        {{--        <a href="{{ route('rubric', ['id' => $statya->rubric->id]) }}"><h4>{{ $statya->rubric->name }}</h4></a>--}}
        <article>
            <div class="twelve columns">
                <h1>Мой профиль</h1>
                <p class="excerpt">
                    <img src="../storage/{{ $user->image }}" alt="desc" width=200 align=left hspace=30>
                    {{ $user->name }}
                </p>
            </div>
        </article>
    </div>
@endsection

@section('sidebar')
    @parent

@endsection

@section('content')

    <section class="section_light">
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название курса</th>
                    <th scope="col">Дата первого занятия</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $record->course['title'] }}</td>
                            <td>{{ date('d.m.Y, H:i', strtotime($record->course['startAt'])) }}</td>
                            <td>
                                @if($record->canDeleteRecord)
                                    <form id="delete-form" action="{{ route('deleteRecord', ['id' => $record->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Удалить запись</button>
                                    </form>
                                @elseif($record->isStarted)
                                    Курс уже начался
                                @else
                                    До начала курса менее одних суток
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection


