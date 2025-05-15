<?php

	namespace App\Repositories;

	use App\Models\Order;
	use Illuminate\Database\Eloquent\Collection;
	use Illuminate\Pagination\LengthAwarePaginator;

	class OrderRepository
	{
		protected $model;

		public function __construct(Order $model)
		{
			$this->model = $model;
		}

		public function find(int $id): ?Order
		{
			return $this->model->findOrFail($id);
		}

		public function create(array $data): Order
		{
			return $this->model->create($data);
		}

		// Другие методы репозитория...

		public function getByUserIdWithPagination(int $userId, int $perPage = 10): LengthAwarePaginator
		{
			return $this->model->where('user_id', $userId)->orderBy('order_date', 'desc')->paginate($perPage);
		}
	}