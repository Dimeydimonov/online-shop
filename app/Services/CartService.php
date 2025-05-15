<?php

	namespace App\Services;

	use App\Repositories\OrderRepository;
	use App\Repositories\Product\ProductRepository;
	use Illuminate\Http\Request;
	use Illuminate\Support\Collection;
	use Illuminate\Support\Facades\Session;

	class CartService
	{
		protected OrderRepository $orderRepository;
		protected ProductRepository $productRepository;

		public function __construct(OrderRepository $orderRepository, ProductRepository $productRepository)
		{
			$this->orderRepository = $orderRepository;
			$this->productRepository = $productRepository;
		}

		public function getCart(): array
		{
			return Session::get('cart', []);
		}

		public function calculateTotalWithoutDiscount(array $cart): float
		{
			$total = 0;
			foreach ($cart as $productId => $item) {
				if (isset($item['price']) && isset($item['quantity'])) {
					$total += $item['price'] * $item['quantity'];
				}
			}
			return $total;
		}

		public function applyDiscount(float $totalWithoutDiscount, ?string $promoCode): float
		{
			if ($promoCode === 'SUPER20') {
				return $totalWithoutDiscount * 0.20; // Скидка 20%
			}

			return 0; // Нет скидки по умолчанию
		}

		public function calculateTotalWithDiscount(float $totalWithoutDiscount, float $discountAmount): float
		{
			return $totalWithoutDiscount - $discountAmount;
		}

		public function getCartDataWithTotals(Request $request): array
		{
			$cart = $this->getCart();
			$totalWithoutDiscount = $this->calculateTotalWithoutDiscount($cart);
			$discount = $this->applyDiscount($totalWithoutDiscount, $request->input('promo_code'));
			$totalWithDiscount = $this->calculateTotalWithDiscount($totalWithoutDiscount, $discount);

			return compact('cart', 'totalWithoutDiscount', 'discount', 'totalWithDiscount');
		}

		public function addToCart(int $productId): bool
		{
			$cart = Session::get('cart', []);

			if (isset($cart[$productId])) {
				$cart[$productId]['quantity']++;
			} else {
				$product = $this->productRepository->find($productId);
				if ($product) {
					$cart[$productId] = [
						'id' => $product->id,
						'name' => $product->name,
						'price' => $product->price,
						'quantity' => 1,
						'image' => $product->image,
					];
				} else {
					return false; // Товар не найден
				}
			}

			Session::put('cart', $cart);
			return true;
		}

		public function removeFromCart(int $productId): bool
		{
			$cart = Session::get('cart', []);

			if (isset($cart[$productId])) {
				unset($cart[$productId]);
				Session::put('cart', $cart);
				return true;
			}

			return false;
		}
	}