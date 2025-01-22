<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <!-- Подключение CSS через Laravel asset() -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="card">
    <div class="card-header">{{ __('Авторизация') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('Адрес электронной почты') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('Пароль') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <div>
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label for="remember">{{ __('Запомнить меня') }}</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-primary">{{ __('Забыли пароль?') }}</a>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn-primary">
                {{ __('Войти') }}
            </button>

            <a href="{{ route('register') }}">Регистрация</a>

            <div class="text-center">
                <label>{{ __('Или войдите с помощью') }}</label>
            </div>

            <a href="{{ route('login.google') }}" class="btn-social">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google">
                <span>Google</span>
            </a>
            <a href="{{ route('login.facebook') }}" class="btn-social">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook">
                <span>Facebook</span>
            </a>
            <a href="{{ route('login.instagram') }}" class="btn-social">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram">
                <span>Instagram</span>
            </a>
        </form>
    </div>
</div>
</body>
</html>
