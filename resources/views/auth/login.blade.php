<form method="post" action="{{ route('process_login') }}">
    @csrf
    Email
    <br>
    <input type="emal" name="email">
    <br>
    Password
    <br>
    <input type="password" name="password">
    <br>
    <button>Login</button>
</form>
