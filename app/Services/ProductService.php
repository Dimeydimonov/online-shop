<?php

	namespace App\Services;

	use App\Models\Product;
	use App\Repositories\Product\ProductRepository;
	use Illuminate\Database\Eloquent\Collection;
	use Illuminate\Http\Request;
	use Illuminate\Pagination\LengthAwarePaginator;
	use Illuminate\Support\Facades\Storage;
	use Illuminate\Support\Str;

	class ProductService
	{
		protected ProductRepository $productRepository;

		public function __construct(ProductRepository $productRepository)
		{
			$this->productRepository = $productRepository;
		}

		public function paginateProducts(int $perPage = 10): LengthAwarePaginator
		{
			return $this->productRepository->paginate($perPage);
		}

		public function getProductById(int $id): ?Product
		{
			return $this->productRepository->find($id);
		}

		public function createProduct(array $data): Product
		{
			return $this->productRepository->create($data);
		}

		public function updateProduct(Product $product, array $data): Product
		{
			return $this->productRepository->update($product, $data);
		}

		public function deleteProduct(Product $product): bool
		{
			return $this->productRepository->delete($product);
		}

		public function toggleProductActive(int $id): ?Product
		{
			$product = $this->getProductById($id);
			if ($product) {
				return $this->productRepository->toggleActive($product);
			}
			return null;
		}

		public function setProductDiscount(int $id, int $discount): ?Product
		{
			$product = $this->getProductById($id);
			if ($product) {
				return $this->productRepository->setDiscount($product, $discount);
			}
			return null;
		}

		public function removeProductDiscount(int $id): ?Product
		{
			$product = $this->getProductById($id);
			if ($product) {
				return $this->productRepository->removeDiscount($product);
			}
			return null;
		}

		public function handleImageUpload(Request $request): ?string
		{
			if ($request->hasFile('image')) {
				$imageName = time() . '.' . $request->image->extension();
				$request->image->move(public_path('img-product'), $imageName);
				return 'img-product/' . $imageName;
			}
			return null;
		}

		public function getAllProducts(): Collection
		{
			return $this->productRepository->all();
		}

		public function getFilteredAndSortedProducts(array $filters): LengthAwarePaginator
		{
			return $this->productRepository->getFilteredAndSorted($filters);
		}
	}