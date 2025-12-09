<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgrammationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'date_at'     => $this->date_at,
            'started_at'  => $this->started_at,
            'ended_at'    => $this->ended_at,
            'description' => $this->description,

            // timestamps
            'created_at'    => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
