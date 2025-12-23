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
            'image'         => env('APP_URL') . '/' . $this->image,
            'new_resume'    => $this->new_resume,
            'location'      => $this->location,
            'content'       => $this->content,

            'status'        => $this->new_status, // draft | published | archived
            'views_count'   => $this->views ?? 0,
            'reads_count'   => $this->reads ?? 0,

            'published_at'  => optional($this->published_at)->toDateString(),

            // timestamps
            'created_at'    => optional($this->created_at)->toDateTimeString(),
            // 'updated_at'    => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
