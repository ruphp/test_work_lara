<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => (float) $this->price,
            'category_id' => $this->category_id,
            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
            ],
            'in_stock' => $this->in_stock,
            'rating' => (float) $this->rating,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
