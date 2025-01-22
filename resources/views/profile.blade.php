<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

</head>
<body>
<div class="card">
    <button class="btn-primary" > <a href="{{ route('home') }}"> Главная страница </a></button>
    <div class="card-header">{{ __('Профиль') }}</div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <div class="profile-field">
                <label>{{ __('Фамилия:') }}</label>
                <input type="text" name="last_name" value="{{ $user->last_name }}">
            </div>
            <div class="profile-field">
                <label>{{ __('Имя:') }}</label>
                <input type="text" name="first_name" value="{{ $user->first_name }}">
            </div>
            <div class="profile-field">
                <label>{{ __('Отчество:') }}</label>
                <input type="text" name="patronymic" value="{{ $user->patronymic }}">
            </div>
            <div class="profile-field">
                <label>{{ __('Дата рождения:') }}</label>
                <input type="date" name="birthdate" value="{{ $user->birthdate }}">
            </div>
            <div class="profile-field">
                <label>{{ __('Телефон:') }}</label>
                <span>{{ $user->phone }}</span>
            </div>
            <div class="profile-field">
                <label>{{ __('Электронная почта:') }}</label>
                <span>{{ $user->email }}</span>
            </div>
            <div class="profile-field">
                <label>{{ __('Адрес доставки:') }}</label>
                <input type="text" name="address" value="{{ $user->address }}">
            </div>
            <div class="profile-field">
                <label>{{ __('Область:') }}</label>
                <input type="text" name="region" value="{{ $user->region }}">
            </div>
            <div class="profile-field">
                <label>{{ __('Район:') }}</label>
                <input type="text" name="district" value="{{ $user->district }}">
            </div>
            <div class="profile-field">
                <label>{{ __('Населенный пункт:') }}</label>
                <input type="text" name="village" value="{{ $user->village }}">
            </div>
            <div class="profile-field">
                <label>{{ __('Новая почта адрес:') }}</label>
                <input type="text" name="new_post_address" value="{{ $user->new_post_address }}">
            </div>
            <button type="submit" class="btn-primary">{{ __('Сохранить') }}</button>
                <button class="btn-primary" > <a href="{{ route('home') }}"> Главная страница </a></button>
        </form>
    </div>
</div>

</body>
</html>
