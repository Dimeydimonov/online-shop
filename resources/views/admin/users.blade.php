@extends('layouts.app')

@section('content')
    @include('components.dashboard-panel')
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
    <div class="containerUser">
        <h1>Управление пользователями</h1>
        <table class="table">
            <thead>
            <tr>
                <th class="col-id">ID</th>
                <th>Ф.И.О. и дата рож.</th>
                <th>Email</th>
                <th class="col-role">Role</th>
                <th class="col-email-verified">Email Valid</th>
                <th class="col-datetime">Создано</th>
                <th class="col-datetime">Обновлен</th>
                <th>Контактные данные</th>
                <th>Адрес</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }} {{ $user->last_name }} {{ $user->patronymic }} <br> {{ $user->birthdate }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->email_verified_at ? 'Да' : 'Нет' }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>Телефон: {{ $user->phone }} <br> Активен: {{ $user->active ? 'Да' : 'Нет' }}</td>
                    <td>{{ $user->address }}, {{ $user->region }}, {{ $user->district }}, {{ $user->village }}, {{ $user->new_post_address }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Редактировать</a>
                        <a href="{{ route('admin.users.delete', $user->id) }}" class="btn btn-danger">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
