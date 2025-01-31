<dashboard-panel class="dashboard-panel">
    <div class="header">
        <div class="logo">Логотип</div>
        <div class="nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="/dashboard">Панель управления</a></li>
                <li class="nav-item"><a href="{{ route('admin.users') }}">Пользователи</a></li>
                <li class="nav-item"><a href="{{ route('admin.products') }}">Товары</a></li>
                <li class="nav-item"><a href="/orders">Заказы</a></li>
                <li class="nav-item"><a href="/settings">Настройки</a></li>
                <li class="nav-item"><a href="/reports">Отчеты</a></li>
            </ul>
        </div>
    </div>
</dashboard-panel>
