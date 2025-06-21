<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input name="name" placeholder="Name" value="{{ old('name') }}" required><br><br>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br><br>

        <select name="role" required>
            <option value="">Select Role</option>
            @foreach ($roles as $role)
                <option value="{{ $role }}">{{ $role }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
</body>
</html>
