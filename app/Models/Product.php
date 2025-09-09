<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Relations\HasMany;
	use App\Models\OrderItem;

	class Product extends Model
	{
		use HasFactory;

		protected $fillable = [
			'name',
			'description',
			'price',
			'category',
			'image',
			'is_active',
			'is_on_sale',
			'sale_price',
			'created_at',
			'updated_at',
		];

		public function orderItems(): HasMany
		{
			return $this->hasMany(OrderItem::class);
		}
	}
