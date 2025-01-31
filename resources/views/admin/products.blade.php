@extends('layouts.app')

@section('content')
    @include('components.dashboard-panel')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    <h1>Управление товарами</h1>

    <!-- Добавление ссылки на создание нового товара -->
    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">Добавить новый товар</a>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Категория</th>
            <th>Активен</th>
            <th>Акция</th>
            <th>Изображение</th>
            <th>Создано</th>
            <th>Обновлено</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}USD</td>
                <td>{{ $product->category }}</td>
                <td>{{ $product->active ? 'Да' : 'Нет' }}</td>
                <td>{{ $product->discount ? $product->discount . '%' : 'Нет' }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('img-product/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                    @else
                        Нет изображения
                    @endif
                </td>
                <td>{{ $product->created_at->format('d.m.Y H:i') }}</td>
                <td>{{ $product->updated_at->format('d.m.Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}">Редактировать</a>
                    <form action="{{ route('admin.products.toggleActive', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit">{{ $product->active ? 'Деактивировать' : 'Активировать' }}</button>
                    </form>
                    <form action="{{ route('admin.products.setDiscount', $product->id) }}" method="POST">
                        @csrf
                        <input type="number" name="discount" placeholder="Скидка (%)">
                        <button type="submit">Установить акцию</button>
                    </form>
                    <form action="{{ route('admin.products.removeDiscount', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit">Удалить акцию</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
