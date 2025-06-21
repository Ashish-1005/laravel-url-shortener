<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function toggleInviteForm() {
            const form = document.getElementById('invite-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

         function toggleForm() {
            document.getElementById('generate-form').style.display = 'block';
        }
    </script>
</head>
<body class="bg-light py-4">
<div class="container">

    <!-- Header + Logout -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Generate URL Button -->
    <div class="mb-3">
        <button class="btn btn-info mb-3" onclick="toggleForm()">Generate URL</button>
        <button class="btn btn-primary" onclick="toggleInviteForm()">Invite</button>
    </div>

   <div id="generate-form" style="display: none">
        <form action="{{ route('urls.store') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label>Long URL</label>
                <input type="url" name="original_url" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Generate</button>
        </form>
    </div>

    <!-- Invite Form -->
    <div id="invite-form" style="display:none;" class="mb-5">
        <h5>Invite Admin or Member</h5>
        <form method="POST" action="{{ route('invite.send') }}">
            @csrf
            <div class="mb-2">
                <label for="email">User Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-2">
                <label for="role">Select Role</label>
                <select name="role" class="form-control" required>
                    <option value="Admin">Admin</option>
                    <option value="Member">Member</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Send Invitation</button>
        </form>
    </div>

    <!-- List of Short URLs (Company-wide) -->
    <h5>Company Short URLs</h5>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                 <th>S.No</th>
                <th>Created By</th>
                <th>Original URL</th>
                <th>Short URL</th>
                <th>Clicks</th>
            </tr>
        </thead>
        <tbody>
         @foreach($urls as $index => $url)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $url->user->name }}</td>
                    <td>{{ $url->original_url }}</td>
                    <td><a href="{{ url($url->short_code) }}" target="_blank">{{ url($url->short_code) }}</a></td>
                    <td>{{ $url->clicks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
</body>
</html>
