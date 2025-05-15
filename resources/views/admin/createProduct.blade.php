@extends('layouts.app')

@section('content')
    @include('components.dashboard-panel')
    <link rel="stylesheet" href="{{ asset('css/createProduct.css') }}">
    <div class="container">
        <h1>Добавить новый товар</h1>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Название товара</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Категория</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="" disabled selected>Выберите категорию</option>
                    <option value="Ноутбуки и компьютеры">Ноутбуки и компьютеры</option>
                    <option value="Смартфоны, ТВ и электроника">Смартфоны, ТВ и электроника</option>
                    <option value="Товары для геймеров">Товары для геймеров</option>
                    <option value="Бытовая техника">Бытовая техника</option>
                    <option value="Товары для дома">Товары для дома</option>
                    <option value="Инструменты и автотовары">Инструменты и автотовары</option>
                    <option value="Сантехника и ремонт">Сантехника и ремонт</option>
                    <option value="Дача, сад и огород">Дача, сад и огород</option>
                    <option value="Спорт и увлечения">Спорт и увлечения</option>
                    <option value="Одежда, обувь и украшения">Одежда, обувь и украшения</option>
                    <option value="Красота и здоровье">Красота и здоровье</option>
                    <option value="Детские товары">Детские товары</option>
                    <option value="Зоотовары">Зоотовары</option>
                    <option value="Офис, школа, книги">Офис, школа, книги</option>
                    <option value="Алкогольные напитки и продукты">Алкогольные напитки и продукты</option>
                    <option value="Бытовая химия">Бытовая химия</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Изображение</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                <label class="form-check-label" for="is_active">Активен</label>
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Скидка (%)</label>
                <input type="number" step="0.01" class="form-control" id="discount" name="discount" min="0" max="100">
            </div>
            <button type="submit" class="btn btn-primary">Добавить товар</button>
        </form>
    </div>
@endsection
