@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
	<div class="cart-page">
		<h1>Корзина</h1>

		@if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		@endif

		@if (session('error'))
			<div class="alert alert-danger">
				{{ session('error') }}
			</div>
		@endif

		@if (empty($cart) || count($cart) === 0)
			<p>Ваша корзина пуста.</p>
			<a href="{{ route('products.index') }}" class="btn btn-primary">Продолжить покупки</a>
		@else
			<table class="table">
				<thead>
				<tr>
					<th>Изображение</th>
					<th>Название</th>
					<th>Цена</th>
					<th>Количество</th>
					<th>Итого</th>
					<th>Действия</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($cart as $productId => $item)
					<tr>
						<td>
							@if ($item['image'])
								<img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" width="50">
							@else
								Нет изображения
							@endif
						</td>
						<td>{{ $item['name'] }}</td>
						<td>{{ $item['price'] }} usd</td>
						<td>
							<input type="number" name="quantity[{{ $productId }}]" value="{{ $item['quantity'] }}"
								   min="1" class="form-control cart-quantity">
						</td>
						<td>{{ $item['price'] * $item['quantity'] }} usd</td>
						<td>
							<form action="{{ route('cart.remove', $productId) }}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger btn-sm">Удалить</button>
							</form>
						</td>
					</tr>
				@endforeach
				</tbody>
				<tfoot>
				<tr>
					<td colspan="4"><strong>Итого без скидки:</strong></td>
					<td>{{ $totalWithoutDiscount }} usd</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4"><strong>Скидка:</strong></td>
					<td>{{ $discount }} usd</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4"><strong>Итого к оплате:</strong></td>
					<td><strong>{{ $totalWithDiscount }} usd</strong></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="6">
						<a href="{{ route('products.index') }}" class="btn btn-secondary">Продолжить покупки</a>
					</td>
				</tr>
				</tfoot>
			</table>

			<div class="cart-checkout-form">
				<h2>Оформление заказа</h2>
				<x-checkout-form :is-guest="$isGuest"/>
			</div>
		@endif
	</div>
@endsection