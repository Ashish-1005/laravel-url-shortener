{{-- <h2>Invite User</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('invite.send') }}">
    @csrf
    <input type="email" name="email" placeholder="User Email" required><br><br>

    <select name="role" required>
        <option value="Admin">Admin</option>
        <option value="Member">Member</option>
    </select><br><br>

    @if($canCreateCompany)
        <input type="text" name="company_name" placeholder="New Company Name" required><br><br>
    @endif

    <button type="submit">Send Invitation</button>
</form> --}}
