<?php

namespace App\Repositories;

use App\Models\Listen;
use App\Repositories\Contracts\ListenRepositoryInterface;

class ListenRepository extends BaseRepository implements ListenRepositoryInterface
{
    public function __construct(Listen $model)
    {
        parent::__construct($model);
    }
}
