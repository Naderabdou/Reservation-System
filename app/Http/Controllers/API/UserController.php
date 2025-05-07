<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\API\LoginRequest;

use App\Http\Controllers\API\Traits\ApiResponseTrait;

class UserController extends Controller
{
    use ApiResponseTrait;


    public function login(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return $this->ApiResponse(null, __('بيانات الدخول غير صحيحة'), 401);
        }

        $user = auth()->user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->ApiResponse(
            [
                'token' => $token,
                'user' => new UserResource($user),
            ],
            __('تم تسجيل الدخول بنجاح'),

        );
    }








    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return $this->ApiResponse(null, __('User logged out successfully'));
    }
}
