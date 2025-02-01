@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">

    <div class="cart-page">
        <div class="cart-container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <h2>Корзина</h2>

            <!-- Товары в корзине -->
            @if (count($cart) > 0)
                <div class="cart-items">
                    @foreach ($cart as $productId => $details)
                        <div class="cart-item">
                            <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}">
                            <h3>{{ $details['name'] }}</h3>
                            <p>Цена: {{ $details['price'] }} USD</p>
                            <p>Количество: {{ $details['quantity'] }}</p>
                            <p>Итого: {{ $details['price'] * $details['quantity'] }} USD</p>

                            <!-- Кнопка удаления товара -->
                            <form action="{{ route('cart.remove', $productId) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-from-cart">Удалить</button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div class="cart-summary">
                    <p>Общая сумма без скидки: {{ $totalWithoutDiscount }} USD</p>
                    <p>Скидка: {{ $discount }} USD</p>
                    <p>Итого к оплате: {{ $totalWithDiscount }} USD</p>

                    <!-- Форма для промокода -->
                    <form action="{{ route('cart') }}" method="GET">

                    <div class="form-item">
                            <label for="promo_code">Промокод</label>
                            <input type="text" name="promo_code" placeholder="Введите промокод" value="{{ request('promo_code') }}">
                        </div>
                        <button type="submit">Применить промокод</button>
                    </form>

                    <!-- Форма оформления -->
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <div class="form-item">
                            <label for="name">ФИО</label>
                            <input type="text" name="name" required>
                        </div>

                        <div class="form-item">
                            <label for="phone">Номер телефона</label>
                            <input type="text" name="phone" required>
                        </div>

                        <div class="form-item">
                            <label for="address">Адрес доставки</label>
                            <input type="text" name="address" required>
                        </div>

                        <div class="form-item">
                            <label for="email">Электронная почта</label>
                            <input type="email" name="email" required>
                        </div>

                        <div class="form-item">
                            <label for="payment_method">Метод оплаты</label>
                            <select name="payment_method">
                                <option value="cash">Наложенный платеж</option>
                                <option value="card">Онлайн картой</option>
                                <option value="delivery">Самовывоз</option>
                            </select>
                        </div>

                        <button type="submit">Оформить заказ</button>

                        @guest
                            <div class="register-suggestion">
                                <p>Чтобы завершить оформление, пожалуйста, зарегистрируйтесь.</p>
                                <a href="{{ route('register') }}" class="register-link">Зарегистрироваться</a>
                            </div>
                        @endguest
                    </form>
                </div>
            @else
                <p>Ваша корзина пуста</p>
            @endif
        </div>
    </div>

@endsection
