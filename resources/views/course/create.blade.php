{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
@extends('layout.master')
@section('content')
<form action="{{ route('courses.store') }}" method="post">
    @csrf
    Name
    <input type="text" name="name" value="{{ old('name') }}">
    @if($errors->has('name'))
        <span class="error">
            {{ $errors->first('name') }}
        </span>
    @endif
    <br>
    <button>Create</button>
</form>
@endsection
