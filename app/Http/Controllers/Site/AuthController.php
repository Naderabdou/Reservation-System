<?php

namespace App\Http\Controllers\Site;

use App\Models\City;
use App\Models\User;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Mail\VerificationCodeMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Requests\Site\RegisterRequest;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Requests\Site\UserUpdateRequest;
use App\Http\Requests\Site\ResetPasswordRequest;
use App\Http\Requests\Site\CodeConfimationRequest;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('site.auth.login');
    }
    public function login(LoginRequest $request)
    {
        $remember = $request->has('remeberMe');

        $key = 'login-attempts:' . $request->ip() . $request->email;
        // Rate Limiting
        $this->RateLimiter($key);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            RateLimiter::clear($key); // Clear the rate limiter on successful login
            return response()->json([
                'status' => true,
                'redirect' => route('site.home'),
            ]);
            // return redirect('/')->with('success', __('Logged in successfully'));
        } else {
            return response()->json([
                'status' => false,
                'errors' => __('Invalid credentials'),
            ], 422);
            // return back()->withInput()->with('error', __('Invalid credentials'));
        }
    }






    public function getRegister()
    {


        return view('site.auth.register');
    }



    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        //assign role
        $user->assignRole('user');

        // $remember = $request->has('rememberMe') && $request->rememberMe;



        Auth::login($user);

        //

        return redirect()->route('site.home')->with('success', __('Registered successfully'));
    }





















    private function RateLimiter($key = null)
    {
        $maxAttempts = 5;
        $decaySeconds = 60;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'status' => false,
                'message' => 'من فضلك انتظر ' . $seconds . ' ثانية قبل المحاولة مرة أخرى',
            ], 429);
        }

        RateLimiter::hit($key, $decaySeconds);
    }








    /*   public function Forgetpassword(Request $request)
    {

    } */
}
