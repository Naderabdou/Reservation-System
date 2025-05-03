<?php

namespace App\Services;

use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function create(User $user, array $data, Service $service): void
    {

        if ($this->isConflict($user, $service->id, $data['reservation_date'])) {
            throw ValidationException::withMessages([
                'reservation_date' => __('يوجد حجز سابق لنفس الخدمة في نفس التاريخ.')
            ]);
        }

        DB::transaction(function () use ($user, $service, $data) {
            $user->orders()->create([
                'order_number' => 'order_' . substr(uniqid(), -6),
                'service_id' => $service->id,
                'service_name' => $service->name,
                'service_price' => $service->price,
                'reservation_date' => $data['reservation_date'],
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ]);
        });
    }

    protected function isConflict(User $user, int $serviceId, string $date): bool
    {
        return $user->orders()
            ->where('service_id', $serviceId)
            ->where('reservation_date', $date)
            ->exists();
    }
}
