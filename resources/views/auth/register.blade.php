<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <!-- Подключение CSS через Laravel asset() -->
    <link rel="stylesheet" href="{{ asset('css/RegAuth.css') }}">
</head>
<body>
<div class="card">
    <div class="card-header">{{ __('Регистрация') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">{{ __('Имя') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">{{ __('Телефон') }}</label>
                <div class="d-flex">
                    <select id="country_code" class="form-control" name="country_code" required>
                        <option value="+38" selected>+38 (Украина)</option>
                        <option value="+1">+1 (США)</option>
                        <option value="+44">+44 (Великобритания)</option>
                        <option value="+49">+49 (Германия)</option>
                        <!-- Добавьте другие коды стран, которые вам нужны -->
                    </select>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="XXXXXXXXX">
                </div>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">{{ __('Адрес электронной почты') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('Пароль') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('Подтвердите пароль') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn-primary">
                {{ __('Регистрация') }}
            </button>
            <a href="{{ route('login') }}"> Зарегистрирован? -> Войти </a>


            <div class="text-center">
                <label>{{ __('Или зарегистрируйтесь с помощью') }}</label>
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
