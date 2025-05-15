<?php

	namespace App\Http\Controllers;

	use App\Http\Requests\StoreUserRequest;

	// сделать позже
	use App\Http\Requests\UpdateUserRequest;

	// сделать позже
	use App\Services\UserService;
	use Illuminate\Http\JsonResponse;
	use Illuminate\Http\Request;
	use Illuminate\Routing\Controller;

	class UserController extends Controller
	{
		protected UserService $userService;

		public function __construct(UserService $userService)
		{
			$this->userService = $userService;
		}

		public function index(): JsonResponse
		{
			$users = $this->userService->getAllUsers();
			return response()->json($users);
		}

		public function active(): JsonResponse
		{
			$activeUsers = $this->userService->getActiveUsers();
			return response()->json($activeUsers);
		}

		public function role(string $role): JsonResponse
		{
			$usersByRole = $this->userService->getUsersByRole($role);
			return response()->json($usersByRole);
		}

		public function show(int $id): JsonResponse
		{
			$user = $this->userService->getUserById($id);
			if (!$user) {
				return response()->json(['message' => 'пользов не найден'], 404);
			}
			return response()->json($user);
		}

		public function store(StoreUserRequest $request): JsonResponse
		{
			$user = $this->userService->createUser($request->validated());
			return response()->json($user, 201);
		}

		public function update(UpdateUserRequest $request, int $id): JsonResponse
		{
			$updatedUser = $this->userService->updateUser($id, $request->validated());
			if (!$updatedUser) {
				return response()->json(['message' => 'не найден'], 404);
			}
			return response()->json($updatedUser);
		}

		public function destroy(int $id): JsonResponse
		{
			$deleted = $this->userService->deleteUser($id);
			if (!$deleted) {
				return response()->json(['message' => 'не найден'], 404);
			}
			return response()->json(['message' => 'пользов удалено']);
		}

		public function paginate(Request $request): JsonResponse
		{
			$perPage = $request->input('per_page', 15);
			$users = $this->userService->paginateUsers($perPage);
			return response()->json($users);
		}

		public function search(Request $request): JsonResponse
		{
			$query = $request->input('query');
			$results = $this->userService->searchUsers($query);
			return response()->json($results);
		}
	}