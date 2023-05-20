<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category' => $this->categories_id,
            'name' => $this->name,
            'min_value_for_purchase' =>$this->min_value_for_purchase,
            'price' => $this->price,
            'price_for_what' => $this->price_for_what,
        ];
    }
}
