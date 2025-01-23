<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Проверяем, авторизован ли пользователь и является ли он администратором
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Если пользователь не администратор, перенаправляем его на главную страницу
        return redirect('/')->with('error', 'У вас нет доступа к этой странице.');
    }
}
