<?php

namespace App\Repositories;

use App\Models\Donation;
use App\Repositories\Contracts\DonationRepositoryInterface;

class DonationRepository extends BaseRepository implements DonationRepositoryInterface
{
    public function __construct(Donation $model)
    {
        parent::__construct($model);
    }
}
