<?php

	namespace App\Http\Controllers;

	use App\Http\Requests\StoreProductRequest;
	use App\Http\Requests\UpdateProductRequest;
	use App\Http\Requests\UpdateUserRequest;
	use App\Services\OrderService;
	use App\Services\ProductService;
	use App\Services\UserService;
	use Illuminate\Routing\Controller;

	class AdminController extends Controller
	{
		protected UserService $userService;
		protected ProductService $productService;
		protected OrderService $orderService;

		public function __construct(UserService $userService, ProductService $productService, OrderService $orderService)
		{
			$this->userService = $userService;
			$this->productService = $productService;
			$this->orderService = $orderService;
		}


		public function index()
		{
			$products = $this->productService->paginateProducts(10);
			return view('dashboard', compact('products'));
		}


		public function users()
		{
			$users = $this->userService->paginateUsers(10);
			return view('admin.users', compact('users'));
		}

		public function editUser($id)
		{
			$user = $this->userService->getUserById($id);
			if (!$user) {
				abort(404);
			}
			return view('admin.edit-user', compact('user'));
		}

		public function updateUser(UpdateUserRequest $request, $id)
		{
			$user = $this->userService->getUserById($id);
			if (!$user) {
				abort(404);
			}
			$this->userService->updateUser($id, $request->validated());
			return redirect()->route('admin.users')->with('success', 'Користувач оновлений');
		}

		public function deleteUser($id)
		{
			$user = $this->userService->getUserById($id);
			if (!$user) {
				abort(404);
			}
			$this->userService->deleteUser($id);
			return redirect()->route('admin.users')->with('success', 'Користувача видалено');
		}


		public function products()
		{
			$products = $this->productService->paginateProducts(10);
			return view('admin.products', compact('products'));
		}

		public function createProduct()
		{
			return view('admin.createProduct');
		}

		public function storeProduct(StoreProductRequest $request): \Illuminate\Http\RedirectResponse
		{
			$data = $request->validated();
			$data['image'] = $this->productService->handleImageUpload($request);
			$this->productService->createProduct($data);
			return redirect()->route('admin.products')->with('success', 'Товар успішно додано');
		}

		public function editProduct($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
		{
			$product = $this->productService->getProductById($id);
			if (!$product) {
				abort(404);
			}
			return view('admin.edit-product', compact('product'));
		}

		public function updateProduct(UpdateProductRequest $request, $id): \Illuminate\Http\RedirectResponse
		{
			$product = $this->productService->getProductById($id);
			if (!$product) {
				abort(404);
			}
			$data = $request->validated();
			$data['image'] = $this->productService->handleImageUpload($request);
			$this->productService->updateProduct($product, $data);
			return redirect()->route('admin.products')->with('success', 'Товар оновлено');
		}

		public function deleteProduct($id)
		{
			$product = $this->productService->getProductById($id);
			if (!$product) {
				abort(404);
			}
			$this->productService->deleteProduct($product);
			return redirect()->route('admin.products')->with('success', 'Товар видалено');
		}


		public function toggleActive($id)
		{
			$product = $this->productService->toggleProductActive($id);
			if ($product) {
				return redirect()->route('admin.products')->with('success', 'Статус товару оновлено');
			}
			return redirect()->route('admin.products')->with('error', 'Товар не знайдено');
		}


		public function setDiscount(Request $request, $id)
		{
			$request->validate([
				'discount' => 'required|numeric|min:0|max:100',
			]);
			$product = $this->productService->setProductDiscount($id, $request->input('discount'));
			if ($product) {
				return redirect()->route('admin.products')->with('success', 'Знижку встановлено');
			}
			return redirect()->route('admin.products')->with('error', 'Товар не знайдено');
		}


		public function removeDiscount($id)
		{
			$product = $this->productService->removeProductDiscount($id);
			if ($product) {
				return redirect()->route('admin.products')->with('success', 'Знижку видалено');
			}
			return redirect()->route('admin.products')->with('error', 'Товар не знайдено');
		}

		public function orders()
		{
			$orders = $this->orderService->getAllOrdersWithPagination(10);
			return view('admin.orders', compact('orders'));
		}
	}