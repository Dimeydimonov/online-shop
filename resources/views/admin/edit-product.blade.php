@extends('layouts.app')

@section('content')
    @include('components.dashboard-panel')
    <link rel="stylesheet" href="{{ asset('css/edit-product.css') }}">
    <div class="container">
        <h1>Редактировать товар</h1>
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Название товара</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Категория</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ $product->category }}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Изображение</label>
                <input type="file" class="form-control" id="image" name="image">
                @if ($product->image)
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="100">
                @endif
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Активен</label>
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Скидка (%)</label>
                <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="{{ $product->discount }}">
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
@endsection
