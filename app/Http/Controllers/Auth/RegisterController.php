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
		public function showRegistrationForm()
		{
			return view('auth.register');
		}


		public function register(Request $request)
		{
			$request->merge([
				'phone' => $request->country_code . $request->phone
			]);

			$this->validator($request->all())->validate();

			$user = $this->create($request->all());

			auth()->login($user);

			if ($user->role === 'admin') {
				return redirect('/dashboard');
			} else {
				return redirect('/');
			}
		}

		protected function validator(array $data)
		{
			return Validator::make($data, [
				'name' => ['required', 'string', 'max:255'],
				'phone' => ['required_without:email', 'nullable', 'string', 'regex:/^\+[1-9]\d{1,14}$/', 'unique:users'],
				'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
				'password' => ['required', 'string', 'min:8', 'confirmed'],
			]);
		}


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
