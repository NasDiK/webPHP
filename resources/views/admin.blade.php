@extends('layouts.main')

@section('header')
    <div class="">
        <article>
            <h2>Админка</h2>
            <div class="" style="display: flex; gap: 30px;">
                <h3>Выберите курс:</h3>
                    <select class="form-select" style="width: 300px; font-size: 16px;">
                        <option selected disabled hidden>Выбрать</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
            </div>
        </article>
    </div>
@endsection

@section('sidebar')
    @parent

@endsection

@section('content')

    <section class="section_light">
        <div class="row" style="min-height: 400px">
            <table class="table" style="min-width: 700px">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название курса</th>
                    <th scope="col">Пользователь</th>
                    <th scope="col">Дата начала курса</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody class="table-body">
                @foreach ($records as $record)
                    <tr>
                        <td>{{ $record->id }}</td>
                        <td>{{ $record->course['title'] }}</td>
                        <td>{{ $record->user['name'] }}</td>
                        <td>{{ date('d.m.Y, H:i', strtotime($record->course['startAt'])) }}</td>
                        <td>
{{--                            @if($record->canDeleteRecord)--}}
                                <form id="delete-form" action="{{ route('deleteRecordInAdminPage', ['id' => $record->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Удалить запись</button>
                                </form>
{{--                            @else--}}
{{--                                До начала курса менее одних суток--}}
{{--                            @endif--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection

@section('js')
    <script>
        $(document).ready( function () {
            $('.form-select').change(function () {
                const item = this.value;

                $.ajax({
                    url: "{{ route('courseRecords') }}",
                    type: 'GET',
                    data: {
                        courseId: item
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (response) => {
                        $('.table-body').html(response);
                    }
                })
            })
        })
    </script>
@endsection



