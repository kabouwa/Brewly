<?php

namespace App\Http\Resources\Public;

use App\Http\Resources\CategoryResource;
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
        // return parent::toArray($request);
        return [
            "category" => new CategoryResource($this->whenLoaded('category')),
            "reference" => $this->reference,
            "title" => $this->title,
            "selling_price" => $this->selling_price,
            "image" => $this->image,
        ];

    }
}
