<?php

	namespace App\Http\Controllers\Auth;

	use App\Http\Controllers\Controller;
	use App\Models\User;
	use Illuminate\Support\Facades\Auth;
	use Laravel\Socialite\Facades\Socialite;

	class SocialAuthController extends Controller
	{
		public function redirectToGoogle()
		{
			return Socialite::driver('google')->redirect();
		}

		public function handleGoogleCallback()
		{
			$user = Socialite::driver('google')->stateless()->user();
			$this->loginOrCreateUser($user, 'google');

			return redirect('/profile');
		}


		public function redirectToFacebook()
		{
			return Socialite::driver('facebook')->redirect();
		}

		public function handleFacebookCallback()
		{
			$user = Socialite::driver('facebook')->stateless()->user();
			$this->loginOrCreateUser($user, 'facebook');

			return redirect('/profile');
		}

		public function redirectToInstagram()
		{
			return Socialite::driver('instagram')->redirect();
		}

		public function handleInstagramCallback()
		{
			$user = Socialite::driver('instagram')->stateless()->user();
			$this->loginOrCreateUser($user, 'instagram');

			return redirect('/profile');
		}

		private function loginOrCreateUser($socialUser, $provider)
		{
			$user = User::firstOrNew(['email' => $socialUser->getEmail()]);
			$user->name = $socialUser->getName();
			$user->provider = $provider;
			$user->provider_id = $socialUser->getId();
			$user->save();

			Auth::login($user, true);
		}
	}
