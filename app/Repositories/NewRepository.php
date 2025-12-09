<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\Contracts\NewRepositoryInterface;

class NewRepository extends BaseRepository implements NewRepositoryInterface
{
    public function __construct(News $model)
    {
        parent::__construct($model);
    }
}
