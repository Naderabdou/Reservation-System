<?php

namespace App\Http\Controllers\API;

use App\Models\City;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\CitiesResource;
use App\Http\Resources\OrderShowResource;
use App\Http\Requests\API\OrderStoreRequest;
use App\Http\Requests\API\OrderStatusRequest;
use App\Http\Controllers\API\Traits\ApiResponseTrait;

class OrderController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        if (!in_array($status, ['pending', 'accepted', 'completed', 'canceled'])) {
            return $this->apiResponse(null, __('Invalid Status'), 400);
        }

        $orders = Order::where('status', $status)->paginate(10);

        return $this->ApiPaginationResponse(OrderResource::collection($orders));
    }
    public function show($id)
    {
        $user = auth()->user();
        $order = $user->orders()->find($id);

        if (!$order) {
            return $this->notFoundResponse();
        }

        return $this->ApiResponse(new OrderResource($order));
    }


    public function cancelOrder($id)
    {
        $user = auth()->user();
        $order = $user->orders()->where('status', 'pending')->find($id);

        if (!$order) {
            return $this->notFoundResponse();
        }

        $order->update(
            [
                'status' => 'canceled',
            ]
        );

        return $this->ApiResponse(null, __('Order Canceled Successfully'), 200);
    }

    // public function chengeOrderStatus($id, $status)
    // {
    //     $statuses = ['accepted', 'completed'];
    //     if (!in_array($status, $statuses)) {
    //         return $this->apiResponse(null, __('Invalid Status'), 400);
    //     }
    //     $order = Order::find($id);
    //     if (!$order) {
    //         return $this->notFoundResponse();
    //     }
    //     $order->update(['status' => $status]);
    //     return $this->ApiResponse(null, __('Order Status Updated Successfully'), 200);
    // }

    public function changeOrderStatus(OrderStatusRequest $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return $this->notFoundResponse();
        }

        $newStatus = $request->status;

        if (!$order->canChangeStatusTo($newStatus)) {
            $allowed = $order->getAllowedNextStatuses();
            return $this->apiResponse(null, __("Can't change status from {$order->status} to $newStatus. Allowed: $allowed"), 400);
        }

        $order->update(['status' => $newStatus]);

        return $this->apiResponse(null, __('Order status updated successfully'), 200);
    }
}
