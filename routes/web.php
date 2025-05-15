<?php

	use App\Http\Controllers\AdminController;
	use App\Http\Controllers\Auth\ForgotPasswordController;
	use App\Http\Controllers\Auth\LoginController;
	use App\Http\Controllers\Auth\RegisterController;
	use App\Http\Controllers\Auth\ResetPasswordController;
	use App\Http\Controllers\Auth\SocialAuthController;
	use App\Http\Controllers\CartController;
	use App\Http\Controllers\HomeController;
	use App\Http\Controllers\ProductController;
	use App\Http\Controllers\ProfileController;
	use App\Http\Controllers\UserController;

	// Добавлено использование UserController
	use Illuminate\Support\Facades\Route;

	Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.createProduct');


	// Главная страница
	Route::get('/home', [HomeController::class, 'index'])->name('home');


	Route::get('/', [ProductController::class, 'index'])->name('products.index');
	Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

	// Панель администратора
	Route::middleware(['auth', 'admin'])->group(function () {
		Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

		// Управление пользователями
		Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
		Route::get('/users/edit/{id}', [AdminController::class, 'editUser'])->name('admin.users.edit');
		Route::put('/users/update/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
		Route::delete('/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

		// Управление товарами
		Route::get('/products', [AdminController::class, 'products'])->name('admin.products');

		Route::get('/products/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.products.edit');
		Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
		Route::put('/products/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
		Route::delete('/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.destroy');


		Route::post('/products/toggle-active/{id}', [AdminController::class, 'toggleActive'])->name('admin.products.toggleActive');
		Route::post('/products/set-discount/{id}', [AdminController::class, 'setDiscount'])->name('admin.products.setDiscount');
		Route::post('/products/remove-discount/{id}', [AdminController::class, 'removeDiscount'])->name('admin.products.removeDiscount');


		Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
		Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
		Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
	});

	// Профиль пользователя
	Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
	Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

	// Сброс пароля
	Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
	Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkPhone'])->name('password.email');
	Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
	Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

	// Социальная аутентификация

	Route::get('login/google', [SocialAuthController::class, 'redirectToGoogle'])->name('login.google');
	Route::get('login/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

	Route::get('login/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('login.facebook');
	Route::get('login/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);

	Route::get('login/instagram', [SocialAuthController::class, 'redirectToInstagram'])->name('login.instagram');
	Route::get('login/instagram/callback', [SocialAuthController::class, 'handleInstagramCallback']);

	// Регистрация и вход
	Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
	Route::post('register', [RegisterController::class, 'register']);

	Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
	Route::post('login', [LoginController::class, 'login']);
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

	// Корзина
	Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
	Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
	Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
	Route::post('/cart/register', [CartController::class, 'register'])->name('cart.register');
	Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
	Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

	// История заказов пользователя
	Route::middleware(['auth'])->group(function () {
		Route::get('/user/orders', [UserController::class, 'orders'])->name('user.orders');
		// Маршрут для просмотра деталей заказа создадим позже
	});

	//подсказки поиска
	Route::get('/search/suggestions', [HomeController::class, 'searchSuggestions']);