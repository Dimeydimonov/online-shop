@extends('layouts.app')

@section('content')
    <h1>Управление товарами</h1>
    <table>
        <thead>
        <tr>
            <th>Название</th>
            <th>Цена</th>
            <th>Активен</th>
            <th>Акция</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}₽</td>
                <td>{{ $product->active ? 'Да' : 'Нет' }}</td>
                <td>{{ $product->discount ? $product->discount . '%' : 'Нет' }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}">Редактировать</a>
                    <form action="{{ route('admin.products.toggleActive', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit">{{ $product->active ? 'Деактивировать' : 'Активировать' }}</button>
                    </form>
                    <form action="{{ route('admin.products.setDiscount', $product->id) }}" method="POST">
                        @csrf
                        <input type="number" name="discount" placeholder="Скидка">
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
