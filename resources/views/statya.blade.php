@extends('layouts.main')

@section('header')
    <div class="row">
        <a href="{{ route('rubric', ['id' => $statya->rubric->id]) }}"><h4>{{ $statya->rubric->title }}</h4></a>
        <article>
            <div class="twelve columns">
                <h1 style="max-width: 90vw">{{ $statya->title }}</h1>
                <p class="excerpt" style="max-width: 90vw   ">
                    {{ $statya->lid }}
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
            <p style="word-break: break-all;"> <img src="../storage/{{ $statya->image }}" alt="desc" width=400 align=left hspace=30>
                {{ $statya->content }}
            </p>
        </div>
    </section>

@endsection