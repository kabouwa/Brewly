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
        // return parent::toArray($request);
        return [
            "reference" => $this->reference,
            "total_price" => $this->total_price,
            "status" => $this->status,
            "note" => $this->note,
            "total_items" => $this->whenLoaded('items', fn () => $this->items->count()),
            "items" => OrderItemResource::collection($this->whenLoaded('items')),
            "created_at" => $this->created_at->format('M d, Y · H:i'),
            "updated_at" => $this->updated_at->format('M d, Y · H:i'),
        ];
    }
}
