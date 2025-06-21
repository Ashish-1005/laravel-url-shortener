<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function toggleForm() {
            document.getElementById('generate-form').style.display = 'block';
        }
    </script>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Member Dashboard</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>

    <button class="btn btn-info mb-3" onclick="toggleForm()">Generate URL</button>

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

    <h5 class="mt-4">Your URLs</h5>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>S.No</th>
                <th>Original URL</th>
                <th>Short URL</th>
                <th>Clicks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($urls as $index => $url)
                <tr>
                    <td>{{ $index + 1 }}</td>
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
