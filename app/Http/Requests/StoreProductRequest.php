<?php

	namespace App\Http\Requests;

	use Illuminate\Foundation\Http\FormRequest;

	class StoreProductRequest extends FormRequest
	{

		public function authorize(): bool
		{
			return auth()->check() && auth()->user()->isAdmin(); // Пример авторизации
		}


		public function rules(): array
		{
			return [
				'name' => 'required|string|max:255',
				'description' => 'nullable|string',
				'price' => 'required|numeric|min:0',
				'discount' => 'nullable|numeric|min:0|max:100',
				'category' => 'required|string|max:255',
				'image' => 'nullable|image|max:2048', // Максимальный размер 2MB
				'is_active' => 'nullable|boolean',
				'is_on_sale' => 'nullable|boolean',
				'sale_price' => 'nullable|numeric|min:0',
			];
		}
	}