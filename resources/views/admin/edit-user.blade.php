@extends('layouts.app')

@section('content')
    @include('components.dashboard-panel')
    <link rel="stylesheet" href="{{ asset('css/edit-users.css') }}">
    <div class="container">
        <h1>Редактировать пользователя</h1>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>Имя</th>
                    <td><input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required></td>
                </tr>
                <tr>
                    <th>Фамилия</th>
                    <td><input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required></td>
                </tr>
                <tr>
                    <th>Отчество</th>
                    <td><input type="text" name="patronymic" class="form-control" value="{{ $user->patronymic }}" required></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email" class="form-control" value="{{ $user->email }}" required></td>
                </tr>
                <tr>
                    <th>Роль</th>
                    <td><input type="text" name="role" class="form-control" value="{{ $user->role }}" required></td>
                </tr>
                <tr>
                    <th>Email подтвержден</th>
                    <td>{{ $user->email_verified_at ? 'Да' : 'Нет' }}</td>
                </tr>
                <tr>
                    <th>Телефон</th>
                    <td><input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required></td>
                </tr>
                <tr>
                    <th>Активен</th>
                    <td><input type="checkbox" name="active" class="form-check-input" {{ $user->active ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <th>Последняя сессия</th>
                    <td>{{ $user->last_session }}</td>
                </tr>
                <tr>
                    <th>Дата рождения</th>
                    <td><input type="date" name="birthdate" class="form-control" value="{{ $user->birthdate ? $user->birthdate->format('Y-m-d') : '' }}" required>
                    </td>
                </tr>
                <tr>
                    <th>Адрес</th>
                    <td><input type="text" name="address" class="form-control" value="{{ $user->address }}" required></td>
                </tr>
                <tr>
                    <th>Регион</th>
                    <td><input type="text" name="region" class="form-control" value="{{ $user->region }}" required></td>
                </tr>
                <tr>
                    <th>Район</th>
                    <td><input type="text" name="district" class="form-control" value="{{ $user->district }}" required></td>
                </tr>
                <tr>
                    <th>Населенный пункт</th>
                    <td><input type="text" name="village" class="form-control" value="{{ $user->village }}" required></td>
                </tr>
                <tr>
                    <th>Адрес постового отделения</th>
                    <td><input type="text" name="new_post_address" class="form-control" value="{{ $user->new_post_address }}" required></td>
                </tr>
                <tr>
                    <th>Создано</th>
                    <td>{{ $user->created_at }}</td>
                </tr>
                <tr>
                    <th>Обновлено</th>
                    <td>{{ $user->updated_at }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn-primary">{{ __('Сохранить') }}</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
@endsection
