<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGOUT</title>
    <link rel="stylesheet" href="{{ asset('css/user-reset-password.css') }}">
</head>
<body>
    <div class="reset-container">
        <div style="margin-bottom: 16px;">
            <a href="{{ route('profile.edit') }}">My Profile</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button type="submit">LOGOUT</button>
        </form>

        
    </div>
</body>
</html>