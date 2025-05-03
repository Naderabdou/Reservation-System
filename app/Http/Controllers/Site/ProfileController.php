<?php

namespace App\Http\Controllers\Site;

use App\Models\City;
use App\Models\Order;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\Site\UserUpdateRequest;
use App\Http\Requests\Site\ResetPasswordRequest;

class ProfileController extends Controller
{

    public function profile()
    {
        $user = auth()->user();

        return view('site.profile.profile', compact('user'));
    }


    public function UserUpdate(UserUpdateRequest $request)
    {


        auth()->user()->update($request->validated());

        return redirect()->back()->with('success', __('updated successfully'));
    }

    public function ResetPassword(ResetPasswordRequest $request)
    {
        $user = Auth::user();

        // التحقق من صحة كلمة المرور القديمة
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => __('كلمة المرور القديمة غير صحيحة.')]);
        }

        // تحديث كلمة المرور
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // تسجيل خروج المستخدم من جميع الأجهزة الأخرى
        Auth::guard('web')->logoutOtherDevices($request->password);



        return back()->with('success', __('تم تغيير كلمة المرور بنجاح.'));
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('site.home')->with('success', __('Logged out successfully'));
    }


}
