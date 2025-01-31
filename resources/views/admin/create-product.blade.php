@extends('layouts.app')

@section('content')
    @include('components.dashboard-panel')
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
                <input type="text" class="form-control" id="category" name="category" required>
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
