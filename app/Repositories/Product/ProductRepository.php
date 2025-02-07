<?php

	namespace App\Repositories\Product;

	use App\Models\Product;
	use Illuminate\Database\Eloquent\Collection;
	use Illuminate\Pagination\LengthAwarePaginator;

	class ProductRepository
	{
		protected $model;

		public function __construct(Product $model)
		{
			$this->model = $model;
		}

		public function paginate(int $perPage = 10): LengthAwarePaginator
		{
			return $this->model->paginate($perPage);
		}

		public function find(int $id): ?Product
		{
			return $this->model->findOrFail($id);
		}

		public function create(array $data): Product
		{
			return $this->model->create($data);
		}

		public function update(Product $product, array $data): Product
		{
			$product->update($data);
			return $product;
		}

		public function delete(Product $product): bool
		{
			return $product->delete();
		}

		public function toggleActive(Product $product): Product
		{
			$product->is_active = !$product->is_active;
			$product->save();
			return $product;
		}

		public function setDiscount(Product $product, int $discount): Product
		{
			$product->discount = $discount;
			$product->save();
			return $product;
		}

		public function removeDiscount(Product $product): Product
		{
			$product->discount = null;
			$product->save();
			return $product;
		}

		public function all(): Collection
		{
			return $this->model->all();
		}

		public function getFilteredAndSorted(array $filters): LengthAwarePaginator
		{
			$query = $this->model->query();

			// Фильтрация по кат
			if (isset($filters['category']) && $filters['category']) {
				$query->where('category', $filters['category']);
			}

			// Сорт
			if (isset($filters['sort']) && $filters['sort']) {
				switch ($filters['sort']) {
					case 'price_asc':
						$query->orderBy('price', 'asc');
						break;
					case 'price_desc':
						$query->orderBy('price', 'desc');
						break;
					case 'newest':
						$query->orderBy('created_at', 'desc');
						break;
					case 'sale':
						$query->where('is_on_sale', true);
						break;
				}
			}

			return $query->paginate(15);
		}
	}