@extends('layout.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.css"/>
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <a class="btn btn-success" href="{{ route('students.create') }}">
                Thêm
            </a>
            <div class="form-group">
                <select id="select-course-name"></select>
            </div>
            <div class="form-group">
                <select id="select-status" class="form-control">
                    <option value="0">Tất cả</option>
                    @foreach($arrStudentStatus as $option => $value)
                        <option value="{{ $value }}">
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>
            <table class="table table-striped table-centered mb-0" id="table-index">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Status</th>
                        <th>Avatar</th>
                        <th>Course Name</th>
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
{{--                            <a class="btn btn-primary" href="{{ route('students.edit', $each) }}">--}}
{{--                                Edit--}}
{{--                            </a>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <form action="{{ route('students.destroy', $each) }}" method="post">--}}
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            $("#select-course-name").select2({
                ajax: {
                    url: "{{ route('courses.api.name') }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                },
                placeholder: 'Search for a Name',
                allowClear: true,
            });

            $('#select-course-name').change( function () {
                table.columns(6).search( this.value ).draw();
            } );

            $('#select-status').change( function () {
                let value = $(this).val();
                table.columns(4).search(value).draw();
            } );



            let table = $('#table-index').DataTable({
                dom: 'Blfrtip',
                select: true,
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        }
                    },
                    'colvis'
                ],
                processing: true,
                serverSide: true,
                ajax: '{!! route('students.api') !!}',
                columnDefs: [
                    { className: "not-export", "targets": [ 3 ]}
                ],
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'gender', name: 'gender' },
                    { data: 'age', name: 'age' },
                    { data: 'status', name: 'status' },
                    {
                        data: 'avatar',
                        targets: 5,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            if(!data){
                                return '';
                            }
                            return `<img src="{{ public_path() }}/${data}">`;
                        }
                    },
                    { data: 'course_name', name: 'course_name' },
                    {
                        data: 'edit',
                        targets: 7,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `<a class="btn btn-primary" href="${data}">
                                        Edit
                                    </a>`;
                        }
                    },
                    {
                        data: 'destroy',
                        targets: 8,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `<form action="${data}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type='button' class="btn-delete btn btn-danger">Delete</button>
                                    </form>`;
                        }
                    },
                ]
            });
            $(document).on('click', '.btn-delete',function (){
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function() {
                        console.log('success');
                        table.draw();
                    },
                    error: function () {
                        console.log('error');
                    }
                });
            });
        });
    </script>
    @endpush
