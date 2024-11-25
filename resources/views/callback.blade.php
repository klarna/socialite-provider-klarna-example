<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in with Klarna Callback</title>
    <style>
      pre {
        white-space: auto;
        background: rgba(0, 0, 0, 0.05);
        padding: 20px;
        border-radius: 5px;
        max-width: 600px;
        overflow-x: auto;
      }
    </style>
</head>
<body>
    <h2>Response from Klarna</h2>
    <p>
      ID: {{ $user->id }}
    </p>
    <p>
      Name: {{ $user->name }}
    </p>
    <p>
      Email: {{ $user->email }}
    </p>
    <p>
      Email Verified: {{ $user->email_verified ? 'true' : 'false' }}
    </p>
    <p>
      Phone: {{ $user->phone }}
    </p>
    <p>
    Phone Verified: {{ $user->phone_verified ? 'true' : 'false' }}
    </p>
    <p>
      Refresh token: <pre>{{ $user->refreshToken }}</pre>
    </p>
</body>
</html>
