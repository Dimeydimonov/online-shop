<?php

	namespace App\Services;

	use App\Models\User;
	use App\Repositories\UserRepository;
	use Illuminate\Database\Eloquent\Collection;
	use Illuminate\Pagination\LengthAwarePaginator;

	class UserService
	{
		protected $userRepository;

		public function __construct(UserRepository $userRepository)
		{
			$this->userRepository = $userRepository;
		}

		public function getUserById(int $id): ?User
		{
			return $this->userRepository->find($id);
		}

		public function getUserByEmail(string $email): ?User
		{
			return $this->userRepository->findByEmail($email);
		}

		public function getAllUsers(): Collection
		{
			return $this->userRepository->all();
		}

		public function getActiveUsers(): Collection
		{
			return $this->userRepository->getActiveUsers();
		}

		public function getUsersByRole(string $role): Collection
		{
			return $this->userRepository->getUsersByRole($role);
		}

		public function createUser(array $userData): User
		{
			$user = new User($userData);
			return $this->userRepository->save($user);
		}

		public function updateUser(int $id, array $userData): ?User
		{
			$user = $this->userRepository->find($id);
			if (!$user) {
				return null;
			}
			$user->fill($userData);
			return $this->userRepository->save($user);
		}

		public function deleteUser(int $id): bool
		{
			$user = $this->userRepository->find($id);
			if (!$user) {
				return false;
			}
			return $this->userRepository->delete($user);
		}

		public function paginateUsers(int $perPage = 15): LengthAwarePaginator
		{
			return $this->userRepository->paginate($perPage);
		}

		public function searchUsers(string $query): Collection
		{
			return $this->userRepository->search($query);
		}

		
	}