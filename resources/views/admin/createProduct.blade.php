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
				<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
					   value="{{ old('name') }}" required>
				@error('name')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="description" class="form-label">Описание</label>
				<textarea class="form-control @error('description') is-invalid @enderror" id="description"
						  name="description">{{ old('description') }}</textarea>
				@error('description')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="price" class="form-label">Цена</label>
				<input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price"
					   name="price" value="{{ old('price') }}" required>
				@error('price')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="category" class="form-label">Категория</label>
				<select class="form-control @error('category') is-invalid @enderror" id="category" name="category"
						required>
					<option value="" disabled selected>Выберите категорию</option>
					<option value="Ноутбуки и компьютеры" {{ old('category') == 'Ноутбуки и компьютеры' ? 'selected' : '' }}>
						Ноутбуки и компьютеры
					</option>
					<option value="Смартфоны, ТВ и электроника" {{ old('category') == 'Смартфоны, ТВ и электроника' ? 'selected' : '' }}>
						Смартфоны, ТВ и электроника
					</option>
					<option value="Товары для геймеров" {{ old('category') == 'Товары для геймеров' ? 'selected' : '' }}>
						Товары для геймеров
					</option>
					<option value="Бытовая техника" {{ old('category') == 'Бытовая техника' ? 'selected' : '' }}>Бытовая
						техника
					</option>
					<option value="Товары для дома" {{ old('category') == 'Товары для дома' ? 'selected' : '' }}>Товары
						для дома
					</option>
					<option value="Инструменты и автотовары" {{ old('category') == 'Инструменты и автотовары' ? 'selected' : '' }}>
						Инструменты и автотовары
					</option>
					<option value="Сантехника и ремонт" {{ old('category') == 'Сантехника и ремонт' ? 'selected' : '' }}>
						Сантехника и ремонт
					</option>
					<option value="Дача, сад и огород" {{ old('category') == 'Дача, сад и огород' ? 'selected' : '' }}>
						Дача, сад и огород
					</option>
					<option value="Спорт и увлечения" {{ old('category') == 'Спорт и увлечения' ? 'selected' : '' }}>
						Спорт и увлечения
					</option>
					<option value="Одежда, обувь и украшения" {{ old('category') == 'Одежда, обувь и украшения' ? 'selected' : '' }}>
						Одежда, обувь и украшения
					</option>
					<option value="Красота и здоровье" {{ old('category') == 'Красота и здоровье' ? 'selected' : '' }}>
						Красота и здоровье
					</option>
					<option value="Детские товары" {{ old('category') == 'Детские товары' ? 'selected' : '' }}>Детские
						товары
					</option>
					<option value="Зоотовары" {{ old('category') == 'Зоотовары' ? 'selected' : '' }}>Зоотовары</option>
					<option value="Офис, школа, книги" {{ old('category') == 'Офис, школа, книги' ? 'selected' : '' }}>
						Офис, школа, книги
					</option>
					<option value="Алкогольные напитки и продукты" {{ old('category') == 'Алкогольные напитки и продукты' ? 'selected' : '' }}>
						Алкогольные напитки и продукты
					</option>
					<option value="Бытовая химия" {{ old('category') == 'Бытовая химия' ? 'selected' : '' }}>Бытовая
						химия
					</option>
				</select>
				@error('category')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="image" class="form-label">Изображение</label>
				<input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
				@error('image')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3 form-check">
				<input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active"
					   name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
				<label class="form-check-label" for="is_active">Активен</label>
				@error('is_active')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="discount" class="form-label">Скидка (%)</label>
				<input type="number" step="0.01" class="form-control @error('discount') is-invalid @enderror"
					   id="discount" name="discount" min="0" max="100" value="{{ old('discount', 0) }}">
				@error('discount')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-primary">Добавить товар</button>
		</form>
	</div>
@endsection