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
            'location'      => $this->location,
            'date'          => $this->date,
            'start_time'    => $this->start_time,
            'end_time'      => $this->end_time,
            'image'         => $this->image,
            'status'        => $this->status,
            'created_at'    => optional($this->created_at)->toDateTimeString(),
            // 'updated_at'    => $this->updated_at,
        ];
    }
}
