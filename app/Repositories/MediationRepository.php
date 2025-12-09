<?php

namespace App\Repositories;

use App\Models\Mediation;
use App\Repositories\Contracts\MediationRepositoryInterface;

class MediationRepository extends BaseRepository implements MediationRepositoryInterface
{
    public function __construct(Mediation $model)
    {
        parent::__construct($model);
    }
}
