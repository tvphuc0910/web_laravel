@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.css"/>
@endpush
@section('content')
    <div class="card">
        @if ($errors->any())
            <div class="card-header">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            </div>
        @endif
        <div class="card-body">
            <a class="btn btn-success" href="{{ route('courses.create') }}">
                Thêm
            </a>
            <table class="table table-striped table-centered mb-0" id="table-index">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

{{--                @foreach($data as $each)--}}
{{--                    <tr>--}}
{{--                        <td>--}}
{{--                            {{ $each->id }}--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            {{ $each->name}}--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            {{ $each->year_created_at }}--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <a class="btn btn-primary" href="{{ route('courses.edit', $each) }}">--}}
{{--                                Edit--}}
{{--                            </a>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <form action="{{ route('courses.destroy', $each) }}" method="post">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button class="btn btn-danger">Delete</button>--}}
{{--                            </form>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
            </table>
            <br>
{{--            <nav>--}}
{{--                <ul class="pagination pagination-rounded mb-0">--}}
{{--                    {{ $data->links() }}--}}
{{--                </ul>--}}
{{--            </nav>--}}
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.js"></script>
    <script>
        $(function() {
            $('#table-index').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('courses.api') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                ]
            });
        });
    </script>
@endpush
