@extends('layouts.app')

@section('content')
    <div class="home-page">
        <div class="content-container">
            @include('components.left-sidebar')
            <div class="main-content">
                <h1>Добро пожаловать в мой интернет-магазин</h1>
                <div class="slider-container">
                    <div class="slider">
                        <div class="slide">Слайд 1</div>
                        <div class="slide">Слайд 2</div>
                        <div class="slide">Слайд 3</div>
                    </div>
                </div>
                <div class="products">
                    @for ($i = 1; $i <= 30; $i++)
                        <div class="product-card">
                            <img src="path/to/image{{ $i }}.jpg" alt="Product Image {{ $i }}">
                            <h2>Название товара {{ $i }}</h2>
                            <p class="price">Цена: {{ 1000 + $i * 50 }}₽</p>
                            <button class="add-to-cart">Добавить в корзину</button>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
