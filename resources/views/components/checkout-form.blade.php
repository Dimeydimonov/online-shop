<form action="{{ route('cart.checkout') }}" method="POST">
	@csrf
	<div class="form-item">
		<label for="name">ФИО</label>
		<input type="text" name="name" required>
	</div>

	<div class="form-item">
		<label for="phone">Номер телефона</label>
		<input type="text" name="phone" required>
	</div>

	<div class="form-item">
		<label for="address">Адрес доставки</label>
		<input type="text" name="address" required>
	</div>

	<div class="form-item">
		<label for="email">Электронная почта</label>
		<input type="email" name="email" required>
	</div>

	<div class="form-item">
		<label for="payment_method">Метод оплаты</label>
		<select name="payment_method">
			<option value="cash">Наложенный платеж</option>
			<option value="card">Онлайн картой</option>
			<option value="delivery">Самовывоз</option>
		</select>
	</div>

	<button type="submit" class="btn btn-success">Подтвердить заказ</button>

	@if ($isGuest)
		<div class="register-suggestion">
			<p>Чтобы завершить оформление, пожалуйста, зарегистрируйтесь.</p>
			<a href="{{ route('register') }}" class="register-link">Зарегистрироваться</a>
		</div>
	@endif
</form>