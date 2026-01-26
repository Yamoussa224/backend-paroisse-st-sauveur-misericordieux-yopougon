<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantEventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'fullname'   => $this->fullname,
            'email'      => $this->email,
            'phone'      => $this->phone,
            'message'    => $this->message,

            'event'      => new EventResource($this->whenLoaded('event')),

            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
