<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            'users_id' => $this->users_id,
            'products' => $this->products,
            'day' => $this->day,
            'from' => date('H:i', strtotime($this->from)),
            'to' => date('H:i', strtotime($this->to)),
            'expired_date' => $this->expired_date,
        ];
    }
}
