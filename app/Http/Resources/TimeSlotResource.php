<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeSlotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'priest_id'    => $this->priest_id,
            'weekday'      => $this->weekday,
            'start_time'   => $this->start_time,
            'end_time'     => $this->end_time,
            'is_available' => (bool)$this->is_available,

            // Relation
            'priest'       => $this->whenLoaded('priest'),

            // timestamps
            'created_at'    => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
