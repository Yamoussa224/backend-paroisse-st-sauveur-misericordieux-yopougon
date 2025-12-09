<?php

namespace App\Repositories;

use App\Models\TimeSlot;
use App\Repositories\Contracts\TimeSlotRepositoryInterface;

class TimeSlotRepository extends BaseRepository implements TimeSlotRepositoryInterface
{
    public function __construct(TimeSlot $model)
    {
        parent::__construct($model);
    }
}
