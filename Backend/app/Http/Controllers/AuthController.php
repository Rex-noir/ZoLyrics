<?php

namespace App\Http\Controllers;

use App\Actions\Authentication\CreateUser;
use App\Actions\Authentication\LoginUser;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $user = CreateUser::run($request->validated());

        return response()->json([
            'message' => 'User created successfully',
            'data' => new UserResource($user),
        ], 201);
    }

    public function login(UserLoginRequest $request)
    {
        $user = LoginUser::run($request->validated());

        if ($user) {
            return response()->json([
                'message' => 'Login success!',
                'data' => new UserResource($user)
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
}
