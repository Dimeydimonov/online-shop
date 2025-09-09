<?php

	namespace App\Http\Requests\Admin\Product;

	use Illuminate\Foundation\Http\FormRequest;

	class StoreProductRequest extends FormRequest
	{

		public function authorize(): bool
		{
			return true;
		}

		public function rules(): array
		{
			return [
				'name' => 'required|string|max:255',
				'description' => 'nullable|string',
				'price' => 'required|numeric|min:0',
				'category' => 'required|string|max:255',
				'image' => 'nullable|image|max:2048', // Example image validation
				'is_active' => 'nullable|boolean',
				'discount' => 'nullable|numeric|min:0|max:100',
			];
		}
	}