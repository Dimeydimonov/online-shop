<?php

	namespace App\Http\Controllers;

	use App\Models\Product;
	use Illuminate\Http\Request;

	class HomeController extends Controller
	{

		public function __construct()
		{
			$this->middleware('auth');
		}


		public function index(Request $request)
		{
			$query = Product::query();

			// Фильтрация по кат
			if ($request->has('category') && $request->category) {
				$query->where('category', $request->category);
			}

			// Сорт
			if ($request->has('sort') && $request->sort) {
				switch ($request->sort) {
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

			// Пагинация товаров
			$products = $query->paginate(15);

			// Передаем данные в представление
			return view('home', [
				'products' => $products,
				'currentCategory' => $request->category,
				'currentSort' => $request->sort,
			]);
		}
	}
