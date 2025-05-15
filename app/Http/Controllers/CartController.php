<?php

	namespace App\Http\Controllers;

	use App\Services\CartService;
	use App\Services\CheckoutService;
	use App\Services\ProductService;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\View\View;

	class CartController extends Controller
	{
		protected CartService $cartService;
		protected ProductService $productService;
		protected CheckoutService $checkoutService;

		public function __construct(CartService $cartService, ProductService $productService, CheckoutService $checkoutService)
		{
			$this->cartService = $cartService;
			$this->productService = $productService;
			$this->checkoutService = $checkoutService;
		}

		/**
		 * Отображение корзины.
		 */
		public function showCart(Request $request): View
		{
			$cartData = $this->cartService->getCartDataWithTotals($request);
			$isGuest = Auth::guest(); // Проверяем, является ли пользователь гостем
			return view('cart', array_merge($cartData, ['isGuest' => $isGuest]));
		}

		/**
		 * Оформление заказа.
		 */
		public function checkout(Request $request): \Illuminate\Http\RedirectResponse
		{
			$checkoutData = $request->only(['name', 'phone', 'address', 'email', 'payment_method']); // Получаем данные из формы
			$user = $this->checkoutService->processCheckout($checkoutData);

			if ($user) {
				return redirect()->route('cart')->with('success', 'Ваш заказ успешно оформлен!');
			} else {
				return redirect()->route('cart')->with('error', 'Произошла ошибка при оформлении заказа. Пожалуйста, попробуйте еще раз.');
			}
		}

		/**
		 * Добавление товара в корзину (AJAX).
		 */
		public function addToCart($productId)
		{
			$product = $this->productService->getProductById($productId);

			if (!$product) {
				return response()->json(['error' => 'Товар не найден!'], 404);
			}

			if ($this->cartService->addToCart($productId)) {
				return response()->json(['success' => true, 'message' => 'Товар добавлен в корзину!']);
			}

			return response()->json(['error' => 'Не удалось добавить товар в корзину.'], 500);
		}

		/**
		 * Удаление товара из корзины.
		 */
		public function removeFromCart($productId): \Illuminate\Http\RedirectResponse
		{
			if ($this->cartService->removeFromCart($productId)) {
				return redirect()->route('cart')->with('success', 'Товар удален из корзины');
			}

			return redirect()->route('cart')->with('error', 'Не удалось удалить товар из корзины.');
		}
	}