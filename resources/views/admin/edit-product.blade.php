@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/edit-product.css') }}">
@endsection

@section('content')
	@include('components.dashboard-panel')
	<div class="container">
		<h1>Редактировать товар</h1>
		<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="mb-3">
				<label for="name" class="form-label">Название товара</label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
					   value="{{ old('name', $product->name) }}" required>
				@error('name')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="description" class="form-label">Описание</label>
				<textarea class="form-control @error('description') is-invalid @enderror" id="description"
						  name="description">{{ old('description', $product->description) }}</textarea>
				@error('description')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="price" class="form-label">Цена</label>
				<input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price"
					   name="price" value="{{ old('price', $product->price) }}" required>
				@error('price')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			@php
				$categories = [
					['id' => 1, 'name' => 'Ноутбуки и компьютеры'],
					['id' => 3,'name' => 'Смартфоны, ТВ и электроника'],
					['id' => 2,'name' => 'Товары для геймеров'],
];
			@endphp
			<div class="mb-3">
				<label for="category" class="form-label">Категория</label>
				<select class="form-control @error('category') is-invalid @enderror" id="category" name="category"
						required>
					<option value="" disabled>Выберите категорию</option>
					@foreach($categories as #category)
						<option value="{{ $category['id'] }}" {{ old('category', $product->category) == 'Ноутбуки и компьютеры' ? 'selected' : '' }}>
							{{ $category['name'] }}
						</option>
					@endforeach
				</select>
				@error('category')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="image" class="form-label">Изображение</label>
				<input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
				@if ($product->image)
					<img src="{{ asset('storage/img-product/' . $product->image) }}" alt="{{ $product->name }}"
						 width="100">
				@endif
				@error('image')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3 form-check">
				<input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active"
					   name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
				<label class="form-check-label" for="is_active">Активен</label>
				@error('is_active')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="discount" class="form-label">Скидка (%)</label>
				<input type="number" step="0.01" class="form-control @error('discount') is-invalid @enderror"
					   id="discount" name="discount" min="0" max="100"
					   value="{{ old('discount', $product->discount) }}">
				@error('discount')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-primary">Обновить</button>
		</form>
	</div>
@endsection