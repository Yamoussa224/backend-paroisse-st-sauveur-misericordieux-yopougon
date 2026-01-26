<?php

namespace App\Repositories;

use App\Models\ParticipantEvent;
use App\Repositories\Contracts\ParticipantEventRepositoryInterface;

class ParticiapantEventRepository extends BaseRepository implements ParticipantEventRepositoryInterface
{
    public function __construct(ParticipantEvent $model)
    {
        parent::__construct($model);
    }
}
