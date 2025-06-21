<h2>Accept Invitation to become {{ $invite->role }}</h2>

<form method="POST" action="{{ route('invite.register', $invite->token) }}">
    @csrf
    <input type="text" name="name" placeholder="Your Name" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br><br>

    <button type="submit">Register</button>
</form>
