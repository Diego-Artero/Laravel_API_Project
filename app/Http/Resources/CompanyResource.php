<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'social_reason'=> $this->social_reason, 
            'fantasy_name' => $this->fantasy_name,
            'cnpj' => $this->cnpj,
            'products' => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
