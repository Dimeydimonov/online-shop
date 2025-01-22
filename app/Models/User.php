<?php


namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'patronymic',
        'birthdate',
        'phone',
        'email',
        'address',
        'region',
        'district',
        'village',
        'new_post_address',
        'password',
        'active',
        'last_session',
        'role', // убедитесь, что role добавлено в fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_session' => 'datetime',
        'birthdate' => 'date',
    ];

    // Метод для проверки, является ли пользователь администратором
    public function isAdmin()
    {
        return $this->role === 'admin'; // проверяем роль на 'admin'
    }
}
