<form action="{{ route('course.store') }}" method="post">
    @csrf
    Name
    <input type="text" name="name">
    <br>
    <button>Thêm</button>
</form>
