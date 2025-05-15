<div class="filters">
	<form action="{{ route('home') }}" method="GET" class="filters-form">
		<div class="filter-item">
			<label for="category">Категория:</label>
			<select name="category" id="category" onchange="this.form.submit()">
				<option value="">Все</option>
				<option value="laptops" {{ request('category') == 'laptops' ? 'selected' : '' }}>Ноутбуки и компьютеры
				</option>
				<option value="smartphones" {{ request('category') == 'smartphones' ? 'selected' : '' }}>Смартфоны, ТВ и
					электроника
				</option>
				<option value="gaming" {{ request('category') == 'gaming' ? 'selected' : '' }}>Товары для геймеров
				</option>
				<option value="home_appliances" {{ request('category') == 'home_appliances' ? 'selected' : '' }}>Бытовая
					техника
				</option>
				<option value="home_goods" {{ request('category') == 'home_goods' ? 'selected' : '' }}>Товары для дома
				</option>
				<option value="tools" {{ request('category') == 'tools' ? 'selected' : '' }}>Инструменты и автотовары
				</option>
				<option value="sanitation" {{ request('category') == 'sanitation' ? 'selected' : '' }}>Сантехника и
					ремонт
				</option>
				<option value="garden" {{ request('category') == 'garden' ? 'selected' : '' }}>Дача, сад и огород
				</option>
				<option value="sports" {{ request('category') == 'sports' ? 'selected' : '' }}>Спорт и увлечения
				</option>
				<option value="clothing" {{ request('category') == 'clothing' ? 'selected' : '' }}>Одежда, обувь и
					украшения
				</option>
				<option value="beauty_health" {{ request('category') == 'beauty_health' ? 'selected' : '' }}>Красота и
					здоровье
				</option>
				<option value="children" {{ request('category') == 'children' ? 'selected' : '' }}>Детские товары
				</option>
				<option value="pets" {{ request('category') == 'pets' ? 'selected' : '' }}>Зоотовары</option>
				<option value="office" {{ request('category') == 'office' ? 'selected' : '' }}>Офис, школа, книги
				</option>
				<option value="alcohol" {{ request('category') == 'alcohol' ? 'selected' : '' }}>Алкогольные напитки и
					продукты
				</option>
				<option value="household" {{ request('category') == 'household' ? 'selected' : '' }}>Бытовая химия
				</option>
			</select>
		</div>
	</form>
	<form>
		<div class="filter-item">
			<label for="sort">Сортировать:</label>
			<select name="sort" id="sort" onchange="this.form.submit()">
				<option value="">По умолчанию</option>
				<option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Цена по возрастанию
				</option>
				<option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Цена по убыванию
				</option>
				<option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Новинки</option>
				<option value="sale" {{ request('sort') == 'sale' ? 'selected' : '' }}>Акции</option>
			</select>
		</div>
	</form>
</div>