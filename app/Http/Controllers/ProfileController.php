<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
/**
* Показать страницу профиля пользователя.
*
* @return \Illuminate\View\View
*/
public function index()
{
$user = Auth::user();
return view('profile', compact('user'));
}

/**
* Сохранить изменения профиля пользователя.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\RedirectResponse
*/
public function update(Request $request)
{
$user = Auth::user();

$request->validate([
'first_name' => 'nullable|string|max:255',
'last_name' => 'nullable|string|max:255',
'patronymic' => 'nullable|string|max:255',
'birthdate' => 'nullable|date',
'address' => 'nullable|string|max:255',
'region' => 'nullable|string|max:255',
'district' => 'nullable|string|max:255',
'village' => 'nullable|string|max:255',
'new_post_address' => 'nullable|string|max:255',
]);

$user->update($request->only([
'first_name',
'last_name',
'patronymic',
'birthdate',
'address',
'region',
'district',
'village',
'new_post_address',
]));

return redirect()->route('home')->with('success', 'Профиль успешно обновлен');
}
}
