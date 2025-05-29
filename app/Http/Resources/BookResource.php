<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\GenreResource;
use App\Http\Resources\ReviewResource;

class BookResource extends JsonResource
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
            'name' => $this->name,
            'title' => $this->title,
            'synopsis'=> $this->synopsis,
            'authors' => new AuthorResource($this->whenLoaded('authors')),
            'genres' => new GenreResource($this->whenLoaded('genres')),
            'reviews'=> ReviewResource::collection($this->whenLoaded('reviews'))
        ];
    }
}
