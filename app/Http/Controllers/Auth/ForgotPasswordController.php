<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Показать форму запроса ссылки на восстановление пароля.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Отправить ссылку на восстановление пароля на телефон.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^\+[1-9]\d{1,14}$/|exists:users,phone',
        ]);

        $token = Str::random(60);

        // Логика сохранения токена и отправки SMS с ссылкой на восстановление пароля
        // Используем Twilio для отправки SMS
        $client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $client->messages->create(
            $request->phone,
            [
                'from' => env('TWILIO_FROM'),
                'body' => 'Ваш токен для восстановления пароля: ' . $token
            ]
        );

        return back()->with('status', 'Ссылка на восстановление пароля отправлена на ваш телефон!');
    }
}
