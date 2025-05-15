<?php

	namespace App\Services;

	use App\Models\Order;
	use App\Models\OrderItem;
	use App\Models\User;
	use App\Repositories\OrderItemRepository;
	use App\Repositories\OrderRepository;
	use Illuminate\Support\Collection;
	use Illuminate\Support\Facades\DB;
	use Throwable;
	use Illuminate\Pagination\LengthAwarePaginator;


	class OrderService
	{
		protected OrderRepository $orderRepository;
		protected OrderItemRepository $orderItemRepository;

		public function __construct(OrderRepository $orderRepository, OrderItemRepository $orderItemRepository)
		{
			$this->orderRepository = $orderRepository;
			$this->orderItemRepository = $orderItemRepository;
		}

		public function getAllOrdersWithPagination(int $perPage = 10): LengthAwarePaginator
		{
			return $this->orderRepository->paginate($perPage);
		}

		public function saveOrder(User $user, Collection $cartItems, array $shippingDetails): ?Order
		{
			$totalPrice = $cartItems->sum(function ($item) {
				return $item['price'] * $item['quantity'];
			});

			$orderData = [
				'user_id' => $user->id,
				'total_price' => $totalPrice,
				'order_date' => now(),
				'status' => 'в обработке',
			];

			try {
				DB::beginTransaction();

				$order = $this->orderRepository->create($orderData);

				foreach ($cartItems as $productId => $itemDetails) {
					$this->orderItemRepository->create([
						'order_id' => $order->id,
						'product_id' => $productId,
						'name' => $itemDetails['name'],
						'price' => $itemDetails['price'],
						'quantity' => $itemDetails['quantity'],
					]);
				}

				DB::commit();

				return $order;

			} catch (Throwable $e) {
				DB::rollBack();
				Log::error('Error saving order: ' . $e->getMessage());
				return null;
			}
		}

		public function findOrder(int $id): ?Order
		{
			return $this->orderRepository->find($id);
		}

		public function getUserOrders(User $user)
		{
			return $this->orderRepository->getByUserIdWithPagination($user->id, 10);
		}

	}