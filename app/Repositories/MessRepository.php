<?php

namespace App\Repositories;

use App\Models\Mess;
use App\Repositories\Contracts\MessRepositoryInterface;

class MessRepository extends BaseRepository implements MessRepositoryInterface
{
    public function __construct(Mess $model)
    {
        parent::__construct($model);
    }
}
