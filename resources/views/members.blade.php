@foreach ($records as $record)
    <tr>
        <th scope="row">{{ $loop->index+1 }}</th>
        <td>{{ $record->course['title'] }}</td>
        <td>{{ date('d.m.Y, H:i', strtotime($record->course['startAt'])) }}</td>
        <td>
{{--            @if($record->canDeleteRecord)--}}
                <form id="delete-form" action="{{ route('deleteRecordInAdminPage', ['id' => $record->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Удалить запись</button>
                </form>
{{--            @else--}}
{{--                До начала курса менее одних суток--}}
{{--            @endif--}}
        </td>
    </tr>
@endforeach
