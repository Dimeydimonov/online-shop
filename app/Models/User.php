<?php

	namespace App\Models;

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
			'role',
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


		public function isAdmin(): bool
		{
			return $this->role === 'admin';
		}
	}