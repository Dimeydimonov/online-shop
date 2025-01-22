@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="logo">Логотип</div>
        <div class="nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="/dashboard">Панель управления</a></li>
                <li class="nav-item"><a href="{{ route('admin.users') }}">Пользователи</a></li>
                <li class="nav-item"><a href="/products">Товары</a></li>
                <li class="nav-item"><a href="/orders">Заказы</a></li>
                <li class="nav-item"><a href="/settings">Настройки</a></li>
                <li class="nav-item"><a href="/reports">Отчеты</a></li>
            </ul>
        </div>
        <div class="search">
            <input type="text" placeholder="Поиск">
            <button>Найти</button>
        </div>
        <div class="account">
            <a href="/logout">Выход</a>
        </div>
    </div>
    <div class="main-container">
        <div class="content-container">
            <div class="left-column">
                <!-- Содержимое левой колонки -->
            </div>
            <div class="main-content">
                <!-- Основной контент -->
                <div class="slider-container">
                    <!-- Слайдер -->
                    <div class="slider">
                        <div class="slide active">Слайд 1</div>
                        <div class="slide">Слайд 2</div>
                        <div class="slide">Слайд 3</div>
                    </div>
                </div>
                <div class="products">
                    <!-- Карточки товаров -->
                    <div class="product-card">
                        <h3>Товар 1</h3>
                        <p>Описание товара 1</p>
                    </div>
                    <div class="product-card">
                        <h3>Товар 2</h3>
                        <p>Описание товара 2</p>
                    </div>
                    <div class="product-card">
                        <h3>Товар 3</h3>
                        <p>Описание товара 3</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
