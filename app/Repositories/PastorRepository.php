<?php

namespace App\Repositories;

use App\Models\Pastor;
use App\Repositories\Contracts\PastorRepositoryInterface;

class PastorRepository extends BaseRepository implements PastorRepositoryInterface
{
    public function __construct(Pastor $model)
    {
        parent::__construct($model);
    }
}
