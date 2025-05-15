@extends('layouts.app')

@section('content')
	@include('components.dashboard-panel')
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
	<div class="containerUser">
		<h1>Управление товарами</h1>
		<div class="filters">
			<form action="{{ route('admin.products') }}" method="GET" class="categories">
				<label for="category">Категория:</label>
				<select name="category" id="category" onchange="this.form.submit()">
					<option value="">Все категории</option>
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
					<option value="Рождественская распродажа до -60%">Рождественская распродажа до -60%</option>
				</select>
				<label for="search">Поиск:</label>
				<input type="text" name="search" id="search" value="{{ request('search') }}"
					   placeholder="Поиск товаров">
				<button type="submit" class="btn btn-search">Найти</button>
			</form>
		</div>

		<a href="{{ route('admin.products.createProduct') }}" class="btn btn-primary">Добавить товар</a>

		<table class="table">
			<thead>
			<tr>
				<th>ID</th>
				<th>Изображение</th>
				<th>Название</th>
				<th>Категория</th>
				<th>Описание</th>
				<th>Цена</th>
				<th>Акция</th>
				<th>Статус</th>
				<th>Создано</th>
				<th>Обновлено</th>
				<th>Действия</th>
			</tr>
			</thead>
			<tbody>
			@foreach ((object) $products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>
						@if($product->image)
							<img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50">
						@else
							Нет изображения
						@endif
					</td>
					<td>{{ $product->name }}</td>
					<td>{{ $product->category }}</td>
					<td>{{ $product->description }}</td>
					<td>{{ $product->price }} USD.</td>
					<td>
						@if ($product->discount)
							<span class="sale">Акция: {{ $product->discount }}%</span>
						@else
							Нет
						@endif
					</td>
					<td>
						@if ($product->active)
							<span class="active">Активен</span>
						@else
							<span class="inactive">Неактивен</span>
						@endif
					</td>
					<td>{{ $product->created_at->format('d.m.Y H:i') }}</td>
					<td>{{ $product->updated_at->format('d.m.Y H:i') }}</td>
					<td class="actions">
						<a href="{{ route('admin.products.edit', $product->id) }}"
						   class="btn btn-edit">Редактировать</a>
						<form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
							  style="display:inline;">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-delete">Удалить</button>
						</form>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		{{ $products->links() }}
	</div>
@endsection
