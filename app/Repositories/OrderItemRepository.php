<?php

	namespace App\Repositories;

	use App\Models\OrderItem;
	use Illuminate\Database\Eloquent\Collection;

	class OrderItemRepository
	{
		protected $model;

		public function __construct(OrderItem $model)
		{
			$this->model = $model;
		}

		
	}
