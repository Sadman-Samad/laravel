<!DOCTYPE html>
<html>
<head>
    <title>My Laravel Docker Project</title>
</head>
<body>
    <h1>Hello, {{ $name }} 👋</h1>
    <p>Welcome to your first Laravel project with Docker + Nginx 🚀</p>

    @if($user)
        <p>Logged in as: {{ $user->name }}</p>
    @else
        <p>You are not logged in.</p>
    @endif

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>


</body>
</html>
