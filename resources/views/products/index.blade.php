@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Все товары</h1>
        <div class="filters">
            <form action="{{ route('products.index') }}" method="GET">
                <select name="sort" onchange="this.form.submit()">
                    <option value="">Сортировка</option>
                    <option value="price_asc">Цена по возрастанию</option>
                    <option value="price_desc">Цена по убыванию</option>
                    <option value="newest">Новинки</option>
                    <option value="sale">Акции</option>
                </select>
            </form>
        </div>
        <div class="products">
            @foreach ($products as $product)
                <div class="product-card">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    <h2>{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                    <p>Цена: {{ $product->price }} руб.</p>
                    @if ($product->is_on_sale)
                        <p class="sale">Акция: {{ $product->sale_price }} руб.</p>
                    @endif
                    <button>Купить</button>
                    <button>Добавить в корзину</button>
                </div>
            @endforeach
        </div>
    </div>
@endsection
