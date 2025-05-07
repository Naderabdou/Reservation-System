<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'service_name' => $this->service_name,
            'service_price' => $this->service_price,
            'reservation_date' => $this->reservation_date,
            'status' => $this->status,
            'created_at' => $this->date,
        ];
    }
}
