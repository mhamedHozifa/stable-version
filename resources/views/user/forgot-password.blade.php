<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="{{ asset('css/user-forgot-password.css') }}">
</head>
<body>
    <div class="forgot-container">
        <h2>Reset Password</h2>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p class="info-text">Enter your email address and we'll send you a link to reset your password.</p>

        <form method="POST" action="{{ route('user.forgot') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
            </div>

            <button type="submit">Send Password Reset Link</button>
        </form>

        <div class="links">
            <a href="{{ route('user.login.form') }}">Back to Login</a>
        </div>
    </div>
</body>
</html>