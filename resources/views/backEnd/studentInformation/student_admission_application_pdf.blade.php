<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Application {{ $application->application_id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { margin-bottom: 6px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f3f4f6; }
    </style>
</head>
<body>
    <h2>Student Admission Application</h2>
    <p><strong>Application ID:</strong> {{ $application->application_id }}</p>
    <p><strong>Status:</strong> {{ ucfirst(str_replace('_',' ', $application->status)) }}</p>

    <table>
        <tr>
            <th>Student Name</th>
            <td>{{ ($payload['first_name'] ?? '') . ' ' . ($payload['last_name'] ?? '') }}</td>
        </tr>
        <tr>
            <th>Class</th>
            <td>{{ $payload['class'] ?? '-' }}</td>
        </tr>
        <tr>
            <th>Board</th>
            <td>{{ $payload['board_id'] ?? '-' }}</td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>{{ $payload['date_of_birth'] ?? '-' }}</td>
        </tr>
        <tr>
            <th>Contact</th>
            <td>{{ $payload['phone_number'] ?? '-' }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $payload['current_address'] ?? '-' }}</td>
        </tr>
    </table>

    <h4>Additional Details</h4>
    <table>
        @foreach ($payload as $key => $value)
            @if (!in_array($key, ['first_name','last_name','class','board_id','date_of_birth','phone_number','current_address']))
                <tr>
                    <th>{{ ucwords(str_replace('_',' ', $key)) }}</th>
                    <td>{{ is_array($value) ? json_encode($value) : $value }}</td>
                </tr>
            @endif
        @endforeach
    </table>
</body>
</html>
