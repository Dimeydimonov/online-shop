<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Перенаправить пользователя на страницу Google OAuth.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Получить информацию пользователя от Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $this->loginOrCreateUser($user, 'google');

        return redirect('/profile');
    }

    /**
     * Перенаправить пользователя на страницу Facebook OAuth.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Получить информацию пользователя от Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $this->loginOrCreateUser($user, 'facebook');

        return redirect('/profile');
    }

    /**
     * Перенаправить пользователя на страницу Instagram OAuth.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToInstagram()
    {
        return Socialite::driver('instagram')->redirect();
    }

    /**
     * Получить информацию пользователя от Instagram.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleInstagramCallback()
    {
        $user = Socialite::driver('instagram')->stateless()->user();
        $this->loginOrCreateUser($user, 'instagram');

        return redirect('/profile');
    }

    /**
     * Логин или создание пользователя.
     *
     * @param $socialUser
     * @param $provider
     * @return void
     */
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
