<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Отображение корзины
    public function showCart(Request $request)
    {
        // Получаем данные корзины из сессии
        $cart = session()->get('cart', []);
        $totalWithoutDiscount = 0;

        // Рассчитываем общую сумму
        foreach ($cart as $id => $details) {
            $totalWithoutDiscount += $details['price'] * $details['quantity'];
        }

        // Применение промокода
        $discount = 0;
        if ($request->has('promo_code') && $request->input('promo_code') === 'DISCOUNT10') {
            // Пример промокода на скидку 10%
            $discount = 0.1 * $totalWithoutDiscount;
        }

        // Итоговая сумма с учетом скидки
        $totalWithDiscount = $totalWithoutDiscount - $discount;

        return view('cart', compact('cart', 'totalWithoutDiscount', 'discount', 'totalWithDiscount'));
    }

    // Оформление заказа
    public function checkout(Request $request)
    {
        // Валидация данных из формы
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
            'payment_method' => 'required|string|in:cash,card,delivery',
        ]);

        // Проверка авторизации
        if (!Auth::check()) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt(str_random(8)), // случайный пароль
            ]);
            Auth::login($user);
        }

        // Логика для сохранения заказа
        // Например, можно сохранить заказ в базе данных или отправить уведомление

        // Очистка корзины после оформления заказа
        session()->forget('cart');

        return redirect()->route('cart')->with('success', 'Ваш заказ успешно оформлен!');
    }

    // Добавление товара в корзину
    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->route('home')->with('error', 'Товар не найден!');
        }

        // Получаем текущую корзину из сессии
        $cart = session()->get('cart', []);

        // Если товар уже есть в корзине, увеличиваем его количество
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            // Если товара нет в корзине, добавляем новый элемент
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        // Обновляем корзину в сессии
        session()->put('cart', $cart);

        // Возвращаем на ту же страницу с сообщением об успешном добавлении товара в корзину
        return back()->with('success', 'Товар добавлен в корзину!');
    }

    // Удаление товара из корзины
    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        // Если товар существует в корзине, удаляем его
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);

            return redirect()->route('cart')->with('success', 'Товар удален из корзины');
        }

        // Если товар не найден в корзине
        return redirect()->route('cart')->with('error', 'Товар не найден в корзине');
    }
}
