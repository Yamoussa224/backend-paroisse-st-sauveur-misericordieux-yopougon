<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'title'            => $this->title,
            'date_at'          => $this->date_at,
            'author'           => $this->author,
            'category'         => $this->category,
            'status'           => $this->mediation_status,
            'views'            => $this->views,

            // Timestamps
            'created_at'    => optional($this->created_at)->toDateTimeString(),
            // 'updated_at'       => $this->updated_at,
        ];
    }
}
