@extends('layouts.app')

@section('content')
	<div class="home-page">
		<div class="content-container">
			@include('components.left-sidebar')
			<div class="main-content">
				@include('components.product-filters')

				<div class="slider-container">
					<div class="slider">
						<div class="slide">Слайд 1</div>
						<div class="slide">Слайд 2</div>
						<div class="slide">Слайд 3</div>
					</div>
				</div>

				<div class="products">
					@foreach ($products as $product)
						<div class="product-card">
							<img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
							<h2>{{ $product->name }}</h2>
							<p>{{ $product->description }}</p>
							<p class="price">Цена: {{ $product->price }}usd</p>
							@if ($product->is_on_sale)
								<p class="sale">Акция: {{ $product->sale_price }}usd</p>
							@endif
							<button class="add-to-cart" data-id="{{ $product->id }}">Добавить в корзину</button>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection