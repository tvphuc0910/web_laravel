@extends('layout.master')
@section('content')


    <form action="{{ route('students.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        Gender
        <input type="radio" name="gender" value="0" checked>Nam
        <input type="radio" name="gender" value="1">Nữ
        <br>
        Birthdate
        <input type="date" name="birthdate">
        <br>
        Status
        <br>
        @foreach($arrStudentStatus as $option => $value)
        <input type="radio" name="status" value="{{ $value }} "
        @if($loop->first)
            checked
        @endif>
            {{ $option }}
            <br>
        @endforeach
        Avatar
        <input type="file" name="avatar">
        <br>
        Course
        <br>
        <select name="course_id">
            @foreach($courses as $course)
                <option value="{{ $course->id }}">
                    {{$course->name}}
                </option>
            @endforeach
        </select>
        <br>
        <button>Create</button>
    </form>
@endsection
