<?php

namespace App\Http\Controllers\User;

use App\Contracts\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        private UserServiceInterface $userService
    ) {}

    public function index(): JsonResponse
    {
        $users = $this->userService->getAllUsers();
        return response()->json($users);
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userService->getUserById($id);
        return $user
            ? response()->json($user)
            : response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }

    public function store(UserRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->validated());
        return response()->json($user, Response::HTTP_CREATED);
    }

    public function update(UserRequest $request, int $id): JsonResponse
    {
        $success = $this->userService->updateUser($id, $request->validated());
        return $success
            ? response()->json(['message' => 'User updated'])
            : response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->userService->deleteUser($id);
        return $success
            ? response()->json(['message' => 'User deleted'])
            : response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }
}
