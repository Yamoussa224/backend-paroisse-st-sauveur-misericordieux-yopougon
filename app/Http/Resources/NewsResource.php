<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'author'        => $this->author,
            'category'      => $this->category,
            'status'        => $this->new_status,
            'views'         => $this->views,
            'published_at'  => $this->published_at,

            // timestamps
            'created_at'    => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
