<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent => =>toArray($request);

        return [
            "category" => new CategoryRessource($this->whenLoaded('category')),
            "reference" => $this->reference,
            "title" => $this->title,
            "purchase_price" => $this->purchase_price,
            "selling_price" => $this->selling_price,
            "stock" => $this->stock,
            "alert_ceil" => $this->alert_ceil,
            "active" => (boolean) $this->active,
            "image" => $this->image,
            'created_at' => $this->created_at->format('M d, Y · H:i'),
            'updated_at' => $this->updated_at->format('M d, Y · H:i'),
        ];
    }
}
