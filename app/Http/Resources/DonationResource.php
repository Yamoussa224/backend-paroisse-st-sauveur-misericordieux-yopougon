<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'donator'        => $this->donator,
            'amount'         => (float) $this->amount,
            'project'        => $this->project,
            'paymethod'      => $this->paymethod,
            'paytransaction' => $this->paytransaction,
            'description'    => $this->description,
            'donation_at'    => optional($this->donation_at)->toDateString(),
            'created_at'     => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
