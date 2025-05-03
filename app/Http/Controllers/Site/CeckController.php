<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CeckController extends Controller
{
    public function email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => __('البريد الالكتروني غير صحيح البنية')]);
        }


        return $this->checkRecordExists('User', 'email', $request->email, $request, __('هذا البريد الالكتروني مستخدم بالفعل'));
    }

    public function CheckDate(Request $request)
    {
        // dd($request->all());
        $service = Order::where('service_id', $request->service_id)->where('reservation_date', $request->reservation_date)->exists();
        if ($service) {
            return response()->json(['message' => __('هذه الخدمة محجوزة في هذا التاريخ مسبقا')]);
        }
        return response()->json(true);
    }

    public function CheckemailDns(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => __('البريد الالكتروني غير صحيح البنية')]);
        }

        return true;
        // return $this->checkRecordExists('User', 'email', $request->email, $request, __('هذا البريد الالكتروني مستخدم بالفعل'));
    }

    public function forgetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => __('البريد الالكتروني غير صحيح')]);
        }
        $user =  User::where('email', $request->email)->exists();
        if (!$user) {
            return response()->json(['message' => __('البريد الالكتروني غير موجود')]);
        }

        return response()->json(true);
    }

    public function phone(Request $request)
    {
        return $this->checkRecordExists('User', 'phone', $request->phone, $request, __('هذا الهاتف مستخدم بالفعل'));
    }

    public function password(Request $request)
    {
        if (Hash::check($request->old_password, auth()->user()->password)) {
            return true;
        } else {
            return response()->json(['message' => __('كلمة المرور القديمة غير صحيحة')]);
        }
    }

    //codeCoupon

    public function codeCoupon(Request $request)
    {

        $coupon =   Coupon::where('code', $request->code)->where('start_date', '<=', now())->where('end_date', '>=', now())->first();

        if ($coupon) {
            $cart = auth()->user()->cart()->where('status', 'pending')->first();


            $cartProductIds = $cart->items()->pluck('product_id');

            if ($coupon->products()->exists()) {

                $couponProductIds = $coupon->products()->pluck('product_id');

                // Check if there's no common product
                if ($cartProductIds->intersect($couponProductIds)->isEmpty()) {
                    return response()->json(['message' => __('هذا الكوبون غير صالح لهذا الطلب')]);
                }
            }

            if ($cart->price < $coupon->value) {
                return response()->json(['message' => __('لا يمكن استخدام الكوبون لان قيمته اكبر من قيمة الطلب')]);
            }
            if ($cart->coupon_id && $cart->coupon_code) {
                return response()->json(['message' => __('لا يمكن استخدام اكثر من كوبون')]);
            }
            return response()->json(true);
        } else {
            return response()->json(['message' => __('كود الخصم غير صحيح او منتهي')]);
        }
    }




    private function checkRecordExists($model, $field, $value, $request, $message)
    {
        $query = 'App\Models\\' . $model;
        $query = new $query;

        if ($request->id) {
            if ($query->where($field, $value)->where('id', '!=', $request->id)->exists()) {
                return response()->json(['message' => transWord($message)]);
            }
        } else {
            if ($query->where($field, $value)->exists()) {
                return response()->json(['message' => transWord($message)]);
            }
        }

        return response()->json(true);
    }
}
