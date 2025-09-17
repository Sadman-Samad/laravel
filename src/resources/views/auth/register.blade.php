<h1>Register</h1>
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif
<form method="POST" action="">
    @csrf
    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
    @error('name') <div>{{ $message }}</div> @enderror

    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
    @error('email') <div>{{ $message }}</div> @enderror

    <input type="password" name="password" placeholder="Password">
    @error('password') <div>{{ $message }}</div> @enderror

    <input type="password" name="password_confirmation" placeholder="Confirm Password">
    <button type="submit">Register</button>
</form>
<a href="{{ route('login') }}">Already have an account? Login</a>
