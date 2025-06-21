<!DOCTYPE html>
<html>
<head>
    <title>Super Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function toggleInviteForm() {
            const form = document.getElementById('invite-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Super Admin Dashboard</h2>
        <div>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="btn btn-outline-secondary">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    {{-- <!-- Clients Table -->
    <h4>Clients</h4>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Client Name</th>
                <th>Email</th>
                <th>Users</th>
                <th>Total Generated URLs</th>
                <th>Total Clicks</th>
            </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->users->first()->email ?? 'N/A' }}</td>
                <td>{{ $company->users->count() }}</td>
                <td>{{ $company->urls->count() }}</td>
                <td>{{ $company->urls->sum('clicks') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table> --}}

    <!-- Invite Form Button -->
    <div class="mt-4">
        <button class="btn btn-primary" onclick="toggleInviteForm()">Invite</button>
    </div>

    <!-- Invite Form -->
    <div id="invite-form" style="display:none; margin-top:30px;">
        <h4>Invite New Client</h4>
        <form method="POST" action="{{ route('invite.send') }}">
            @csrf
            <input type="hidden" name="role" value="Admin">
            <div class="mb-3">
                <label for="company_name">Client or Company Name</label>
                <input type="text" name="company_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Send Invitation</button>
        </form>
    </div>

    <!-- All Short URLs Table -->
    <hr class="my-5">
    <h4>All Short URLs (All Companies)</h4>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>S.No</th>
                <th>Company</th>
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
                    <td>{{ $url->user->company->name ?? 'N/A' }}</td>
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
