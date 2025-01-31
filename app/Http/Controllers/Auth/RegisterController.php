<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Показать форму регистрации.
     *
     * @return View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /*
     * Обработка запроса на регистрацию.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request)
    {
        // Объединение кода страны и номера телефона
        $request->merge([
            'phone' => $request->country_code . $request->phone
        ]);

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        auth()->login($user);

        // Перенаправление в зависимости от роли пользователя
        if ($user->role === 'admin') {
            return redirect('/dashboard');
        } else {
            return redirect('/');
        }
    }

    /**
     * Получить валидатор для запроса на регистрацию.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required_without:email', 'nullable', 'string', 'regex:/^\+[1-9]\d{1,14}$/', 'unique:users'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Создать нового пользователя после успешной регистрации.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'password' => Hash::make($data['password']),
        ]);
    }
}
