<?php

	namespace App\Http\Controllers;

	use App\Services\ProductService;
	use Illuminate\Http\Request;

	class ProductController extends Controller
	{
		protected ProductService $productService;

		public function __construct(ProductService $productService)
		{
			$this->productService = $productService;
		}

		public function index(Request $request)
		{
			$filterParams = $request->all();
			$products = $this->productService->getFilteredAndSortedProducts($filterParams);
			return view('home', compact('products'));
		}

		public function show(int $id)
		{
			$product = $this->productService->getProductById($id);
			if (!$product) {
				abort(404);
			}
			return view('products.show', compact('product'));
		}
	}