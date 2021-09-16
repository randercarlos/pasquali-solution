<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UsersService;

class UsersController extends Controller
{
    private $usersService;

    public function __construct(UsersService $usersService) {
        $this->usersService = $usersService;
    }

    public function index()
    {
        return response()->success(UserResource::collection($this->usersService->loadAll()));
    }

    public function show(int $id)
    {
        return response()->success(new UserResource($this->usersService->find($id)));
    }

    public function store(UserRequest $request)
    {
        return response()->success($this->usersService->save($request->validated()), 201);
    }

    public function update(UserRequest $request, User $user)
    {
        return response()->success($this->usersService->save($request->validated(), $user));
    }

    public function destroy(int $id)
    {
        return response()->success($this->usersService->delete($id), 204);
    }

}
