@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="logo">Логотип</div>
        <div class="nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="/dashboard">Панель управления</a></li>
                <li class="nav-item"><a href="{{ route('admin.users') }}">Пользователи</a></li>
                <li class="nav-item"><a href="{{ route('admin.products') }}">Товары</a></li>
                <li class="nav-item"><a href="/orders">Заказы</a></li>
                <li class="nav-item"><a href="/settings">Настройки</a></li>
                <li class="nav-item"><a href="/reports">Отчеты</a></li>
            </ul>
        </div>
    </div>
    <div class="main-container">
        <div class="content-container">
            <div class="left-column">
                <!-- Фильтры и категории -->
                <div class="filters">
                    <h3>Фильтры</h3>
                    <form action="{{ route('admin.products') }}" method="GET">
                        <label for="category">Категория:</label>
                        <select name="category" id="category" onchange="this.form.submit()">
                            <option value="">Все категории</option>
                            <option value="Ноутбуки">Ноутбуки</option>
                            <option value="Смартфоны">Смартфоны</option>
                            <option value="Товары для дома">Товары для дома</option>
                            <!-- Добавьте другие категории -->
                        </select>
                    </form>
                </div>
            </div>
            <div class="main-content">
                <!-- Основной контент -->
                <h1>Управление товарами</h1>

                <!-- Кнопка для добавления нового товара -->
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Добавить товар</a>

                <!-- Таблица товаров -->
                <table class="products-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Цена</th>
                        <th>Акция</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->price }} руб.</td>
                            <td>
                                @if ($product->is_on_sale)
                                    <span class="sale">Акция: {{ $product->sale_price }} руб.</span>
                                @else
                                    Нет
                                @endif
                            </td>
                            <td>
                                @if ($product->is_active)
                                    <span class="active">Активен</span>
                                @else
                                    <span class="inactive">Неактивен</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-edit">Редактировать</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
