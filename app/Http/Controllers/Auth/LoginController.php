<?php

	namespace App\Http\Controllers\Auth;

	use App\Http\Controllers\Controller;
	use Illuminate\Foundation\Auth\AuthenticatesUsers;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;

	class LoginController extends Controller
	{
		use AuthenticatesUsers;


		protected function authenticated(Request $request, $user)
		{
			if ($user->role === 'admin') {
				return redirect()->intended('/dashboard');
			} else {
				return redirect()->intended('/');
			}
		}


		public function logout(Request $request)
		{
			Auth::logout();
			$request->session()->invalidate();
			$request->session()->regenerateToken();

			return redirect('/')->withHeaders([
				'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
				'Pragma' => 'no-cache',
				'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
			]);
		}
	}
