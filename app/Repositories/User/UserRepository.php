<?php

	namespace App\Repositories\User;

	use App\Models\User;
	use Illuminate\Database\Eloquent\Collection;
	use Illuminate\Pagination\LengthAwarePaginator;

	class UserRepository
	{
		protected $model;

		public function __construct(User $model)
		{
			$this->model = $model;
		}

		public function find(int $id): ?User
		{
			return $this->model->findOrFail($id);
		}

		public function findByEmail(string $email): ?User
		{
			return $this->model->where('email', $email)->first();
		}

		public function all(): Collection
		{
			return $this->model->all();
		}

		public function save(User $user): User
		{
			$user->save();
			return $user;
		}

		public function delete(User $user): bool
		{
			return $user->delete();
		}

		public function paginate(int $perPage = 15): LengthAwarePaginator
		{
			return $this->model->paginate($perPage);
		}

		public function findByName(string $name): Collection
		{
			return $this->model->where('name', 'like', '%' . $name . '%')->get();
		}

		public function findByFirstName(string $firstName): Collection
		{
			return $this->model->where('first_name', 'like', '%' . $firstName . '%')->get();
		}

		public function findByLastName(string $lastName): Collection
		{
			return $this->model->where('last_name', 'like', '%' . $lastName . '%')->get();
		}

		public function findByPhone(string $phone): ?User
		{
			return $this->model->where('phone', $phone)->first();
		}

		public function getActiveUsers(): Collection
		{
			return $this->model->where('active', true)->get();
		}

		public function getUsersByRole(string $role): Collection
		{
			return $this->model->where('role', $role)->get();
		}

		public function search(string $query): Collection
		{
			return $this->model->where('name', 'like', '%' . $query . '%')
				->orWhere('first_name', 'like', '%' . $query . '%')
				->orWhere('last_name', 'like', '%' . $query . '%')
				->orWhere('email', 'like', '%' . $query . '%')
				->orWhere('phone', 'like', '%' . $query . '%')
				->get();
		}
	}