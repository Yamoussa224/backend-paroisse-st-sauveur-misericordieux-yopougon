<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Event
 * 
 * @property int $id
 * @property string $title
 * @property Carbon $date_at
 * @property Carbon $time_at
 * @property string $location_at
 * @property string|null $description
 * @property string $image
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Event extends Model
{
	use SoftDeletes;

	protected $guarded = [];
}
