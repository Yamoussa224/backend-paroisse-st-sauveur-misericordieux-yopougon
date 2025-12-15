<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'date_at'       => $this->date_at,
            'time_at'       => $this->time_at,
            'image'         => $this->image,
            'location_at'   => $this->location_at,
            'created_at'    => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
