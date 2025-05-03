<?php

namespace App\Http\Controllers\Site;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ServiceStoreRequest;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('service')->latest()->get();


        return view("site.profile.myorders", compact("orders"));
    }

    public function show(Order $order)
    {
        return view("site.profile.orderDetails", compact('order'));
    }

    //store

    public function store(ServiceStoreRequest $request, OrderService $orderService)
    {
        $data = $request->validated();
        $service = Service::where('is_available', true)->findOrFail($data['service_id']);

        $user = auth()->user();
        $orderService->create($user, $data, $service);
        $title = 'يريد العميل ' . $user->name . ' طلب خدمة' . '  اسمه ' . $service->name . ' وهذا رقمه ' . $user->phone;

        sendNotifyAdmin($title, 'عرض الطلب', route('filament.admin.resources.orders.index'));
        return response()->json(['success' => true, 'message' => __('تم إنشاء الطلب بنجاح.')]);
    }

    public function cancel(Order $order)
    {
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', __('لا يمكنك الغاء الطلب'));
        }
        $order->update(['status' => 'canceled']);
        return redirect()->back()->with('success', __('تم الغاء الطلب بنجاح'));
    }
}
