<h1>Login</h1>
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif
<form method="POST" action="">
    @csrf
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>
</form>
<a href="{{ route('register') }}">Don't have an account? Register</a>
