@extends('layouts.main')

@section('header')
    <a href="{{ route('index') }}"><h1>Новости науки</h1></a>
@endsection

@section('sidebar')
    @parent

    <script type="text/javascript">
        //<![CDATA[
        $('ul#menu-header').nav-bar();
        //]]>
    </script>
@endsection

@section('content')
    <section>
        <div class="section_main">

            <div class="row">

                <section class="eight columns">

                    <h3>{{$rubric->name}}</h3>

                    @foreach ($news as $statya)
                        <article class="blog_post">

                            <div class="three columns">
                                <a href="{{ route('rubric', ['id' => $statya->rubrics]) }}" class="th"><img src="../storage/{{ $statya->image }}" alt="desc" /></a>
                            </div>
                            <div class="nine columns">
                                <a href="{{ route('statya', ['id' => $statya->id]) }}"><h4>{{ $statya->title }}</h4></a>
                                <p> {{ explode('.', $statya->content)[1] ??  explode('.', $statya->content)[0]}}.</p>

                                @if($role === 'ADMIN')
                                    <form id="delete-form" action="{{ route('deleteNews', ['id' => $statya->id, 'from' => 'rubric']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Удалить</button>
                                    </form>
                                @endif
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
                                        <a href="{{ route('add') }}"><h5>Добавить статью</h5></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </section>
@endsection