<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN-SIAKAD</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="layout">
    <div class="left-card">
        <form class="card-main" method="POST" action="{{ route('login') }}">
            @csrf
            <h3>Login</h3>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <label for="email">Email</label>
            <div class="input-box">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            </div>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <div class="input-box">
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <!-- Remember Me -->
            <div class="block mt-4" style="text-align: left; margin-bottom: 15px;">
                <label for="remember_me" style="display: inline-flex; align-items: center; font-size: 13px;">
                    <input id="remember_me" type="checkbox" name="remember" style="margin-right: 8px;">
                    <span>{{ __('Remember me') }}</span>
                </label>
            </div>

            <button type="submit" class="btn-main">Masuk</button>

            @if (Route::has('password.request'))
                <div style="text-align: center; margin-top: 15px;">
                    <a href="{{ route('password.request') }}" style="color: #6d6dff; text-decoration: none; font-size: 13px;">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>

</body>
</html>
