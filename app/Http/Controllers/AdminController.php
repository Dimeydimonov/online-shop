<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Отображение панели администратора
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $products = Product::paginate(10);
        return view('dashboard', compact('products'));
    }

    // Управление пользователями
    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.users')->with('success', 'Пользователь обновлен');
    }

    public function deleteUser($id): \Illuminate\Http\RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Пользователь удален');
    }

    // Управление товарами
    public function products(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $products = Product::paginate(10);
        return view('admin.products', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.create-product');
    }

    public function storeProduct(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean',
            'discount' => 'nullable|numeric',
        ]);

        $product = new Product($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Товар успешно добавлен');
    }

    public function editProduct($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $product = Product::findOrFail($id);
        return view('admin.edit-product', compact('product'));
    }

    public function updateProduct(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->except('image'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs('img-product', $request->file('image')->getClientOriginalName(), 'public');
            $product->image = $imagePath;
            $product->save();
        }

        return redirect()->route('admin.products')->with('success', 'Товар обновлен');
    }


    public function deleteProduct($id): \Illuminate\Http\RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Товар удален');
    }

    // Добавленные методы

    // Переключение статуса товара (активный/неактивный)
    public function toggleActive($id): \Illuminate\Http\RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->active = !$product->active;
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Статус товара обновлен');
    }

    // Установка скидки на товар
    public function setDiscount(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $product = Product::findOrFail($id);
        $product->discount = $request->input('discount');
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Скидка установлена');
    }

    // Удаление скидки с товара
    public function removeDiscount($id): \Illuminate\Http\RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->discount = null;
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Скидка удалена');
    }
}
