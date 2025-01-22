<div class="header-banner">
    <p>РІЗДВЯНО-НОВОРІЧНИЙ РОЗПРОДАЖ ДО -60%</p>
</div>
<header class="header">
    <div class="logo">SHOP-Petrovich</div>
    <nav class="nav">
        <ul class="nav-list">
            <li class="nav-item"><a href="#">Каталог</a></li>
            <li class="nav-item"><a href="#">Розпродаж 2024</a></li>
        </ul>
    </nav>
    <div class="search">
        <input type="text" placeholder="Я ищу..." />
        <button>Найти</button>
    </div>
    <div class="account">
        @auth
            <a href="{{ route('profile') }}"> Профиль </a>
            <a href="#">Корзина</a>
            <a href="{{ route('login') }}">Выйти</a>
        @else
            <a href="#">Корзина</a>
            <a href="{{ route('login') }}">Войти</a>
            <a href="{{ route('register') }}" >Регистрация</a>
        @endauth
    </div>
</header>
