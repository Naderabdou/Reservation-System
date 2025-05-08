<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

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
        if (!$user->hasRole('admin')) {
            Auth::logout(); // نطرده لو مش أدمن
            return response()->json(['message' => 'Unauthorized This User Is Not Admin'], 403);
        }

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
