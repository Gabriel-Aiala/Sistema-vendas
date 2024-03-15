<?php

namespace App\Domains\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\User\Services\UserService;
use App\Domains\User\Http\Requests\UserCreateRequest;
use App\Domains\User\Resources\UserResource;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function store(UserCreateRequest $request)
    {
        $user = $this->userService->createUser($request->all());

        return new UserResource($user);
    }
    
}