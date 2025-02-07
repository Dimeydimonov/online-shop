@extends('layouts.app')

@section('content')
	@include('components.dashboard-panel')
	<link rel="stylesheet" href="{{ asset('css/products.css') }}">
	<h1>Управление товарами</h1>

	<a href="{{ route('admin.products.createProduct') }}" class="btn btn-success mb-3">Добавить новый товар</a>

	@if(session('success'))
		<div class="alert alert-success">{{ session('success') }}</div>
	@endif

	<table>
		<thead>
		<tr>
			<th>ID</th>
			<th>Название</th>
			<th>Описание</th>
			<th>Цена</th>
			<th>Категория</th>
			<th>Активен</th>
			<th>Скидка (%)</th>
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
				<td>{{ $product->price }} USD</td>
				<td>{{ $product->category }}</td>
				<td>{{ $product->is_active ? 'Да' : 'Нет' }}</td>
				<td>{{ $product->discount ? $product->discount : 'Нет' }}</td>
				<td>
					@if($product->image)
						<img src="{{ asset('storage/img-product/' . $product->image) }}" alt="{{ $product->name }}"
							 width="50">
					@else
						Нет изображения
					@endif
				</td>
				<td>{{ $product->created_at->format('d.m.Y H:i') }}</td>
				<td>{{ $product->updated_at->format('d.m.Y H:i') }}</td>
				<td>
					<a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary">Редактировать</a>
					<form action="{{ route('admin.products.toggleActive', $product->id) }}" method="POST"
						  class="d-inline">
						@csrf
						<button type="submit"
								class="btn btn-sm {{ $product->is_active ? 'btn-warning' : 'btn-success' }}">{{ $product->is_active ? 'Деактивировать' : 'Активировать' }}</button>
					</form>
					<form action="{{ route('admin.products.setDiscount', $product->id) }}" method="POST"
						  class="d-inline">
						@csrf
						<input type="number" name="discount" class="form-control form-control-sm d-inline-block w-auto"
							   placeholder="Скидка (%)">
						<button type="submit" class="btn btn-sm btn-info">Установить</button>
					</form>
					<form action="{{ route('admin.products.removeDiscount', $product->id) }}" method="POST"
						  class="d-inline">
						@csrf
						<button type="submit" class="btn btn-sm btn-danger">Удалить скидку</button>
					</form>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection