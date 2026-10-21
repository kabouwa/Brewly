<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "product" => new ProductResource($this->whenLoaded('product')),
            "order_reference" => $this->whenLoaded('order', fn () => $this->order->reference),
            "purchase_price" => $this->purchase_price,
            "selling_price" => $this->selling_price,
            "quantity" => $this->quantity,
            "created_at" => $this->created_at->format('M d, Y · H:i'),
            "updated_at" => $this->updated_at->format('M d, Y · H:i')
        ];
    }
}
