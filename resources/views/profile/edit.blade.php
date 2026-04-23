<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="{{ asset('css/user-profile.css') }}">
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h2>My Profile</h2>
            <div class="profile-nav">
                <a href="{{ route('profile.edit') }}">My Profile</a>
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
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

        <div class="form-section">
            <h3>Profile Details</h3>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <button type="submit">Update Profile</button>
            </form>
        </div>
    </div>
</body>
</html>
