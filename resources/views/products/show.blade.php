@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
        <p>{{ $product->description }}</p>
        <p>Цена: {{ $product->price }} руб.</p>
        @if ($product->is_on_sale)
            <p class="sale">Акция: {{ $product->sale_price }} руб.</p>
        @endif
        <button>Купить</button>
        <button>Добавить в корзину</button>
    </div>
@endsection
