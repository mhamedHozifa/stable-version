<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/user-reset-password.css') }}">
</head>
<body>
    <div class="reset-container">
        <h2>Create New Password</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.reset') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="{{ $email ?? old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit">Reset Password</button>
        </form>

        <div class="links">
            <a href="{{ route('user.login.form') }}">Back to Login</a>
        </div>
    </div>
</body>
</html>