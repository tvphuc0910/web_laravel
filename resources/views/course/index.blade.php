<a href="{{ route('course.create') }}">
    Thêm
</a>
<table border="1" width="100%">
    <tr>
        <th>#</th>
        <th>name</th>
        <th>Created At</th>
    </tr>
    @foreach($data as $each)
        <tr>
            <td>
                {{ $each->id }}
            </td>
            <td>
                {{ $each->name}}
            </td>
            <td>
                {{ $each->year_created_at }}
            </td>
        </tr>
    @endforeach
</table>
