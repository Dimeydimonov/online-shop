<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\Product\StoreProductRequest;
	use App\Http\Requests\Admin\Product\UpdateProductRequest;
	use App\Models\Product;
	use App\Services\ProductService;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\View\View;

	class ProductController extends Controller
	{
		protected ProductService $productService;

		public function __construct(ProductService $productService)
		{
			$this->productService = $productService;
		}

		public function index(): View
		{
			$products = $this->productService->getAllProducts();
			return view('admin.products', compact('products'));
		}

		public function createProduct(): View
		{
			return view('admin.createProduct');
		}

		public function store(StoreProductRequest $request): RedirectResponse
		{
			$imagePath = $this->productService->handleImageUpload($request);
			$data = $request->validated();
			$data['image'] = $imagePath;
			$this->productService->createProduct($data);
			return redirect()->route('admin.products.index')->with('success', 'Товар успешно добавлен.');
		}

		public function edit(int $id): View
		{
			$product = $this->productService->getProductById($id);
			if (!$product) {
				abort(404);
			}
			return view('admin.edit-product', compact('product'));
		}

		public function update(UpdateProductRequest $request, int $id): RedirectResponse
		{
			$product = $this->productService->getProductById($id);
			if (!$product) {
				abort(404);
			}
			$data = $request->validated();
			$imagePath = $this->productService->handleImageUpload($request);
			if ($imagePath) {
				// Удалить старое изображение, если есть
				if ($product->image && Storage::exists('public/' . $product->image)) {
					Storage::delete('public/' . $product->image);
				}
				$data['image'] = $imagePath;
			}
			$this->productService->updateProduct($product, $data);
			return redirect()->route('admin.products.index')->with('success', 'Товар успешно обновлен.');
		}

		public function toggleActive(int $id): RedirectResponse
		{
			$product = $this->productService->getProductById($id);
			if (!$product) {
				abort(404);
			}
			$this->productService->toggleProductActive($id);
			return redirect()->route('admin.products.index')->with('success', 'Статус товара успешно изменен.');
		}

		public function setDiscount(int $id, Request $request): RedirectResponse
		{
			$discount = $request->input('discount');
			$product = $this->productService->getProductById($id);
			if (!$product) {
				abort(404);
			}
			$this->productService->setProductDiscount($id, $discount);
			return redirect()->route('admin.products.index')->with('success', 'Скидка на товар успешно установлена.');
		}

		public function removeDiscount(int $id): RedirectResponse
		{
			$product = $this->productService->getProductById($id);
			if (!$product) {
				abort(404);
			}
			$this->productService->removeProductDiscount($id);
			return redirect()->route('admin.products.index')->with('success', 'Скидка с товара успешно удалена.');
		}
	}