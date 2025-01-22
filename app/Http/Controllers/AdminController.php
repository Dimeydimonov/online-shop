<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // Убедитесь, что путь к представлению правильный
    }

public function users()
{
    $users = User::all(); // Получение всех пользователей из базы данных
    return view('admin.users', compact('users'));
}

    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.editUser', compact('user'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.users')->with('success', 'Пользователь удален');
        }
        return redirect()->route('admin.users')->with('error', 'Пользователь не найден');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Данные пользователя обновлены');
    }





}

