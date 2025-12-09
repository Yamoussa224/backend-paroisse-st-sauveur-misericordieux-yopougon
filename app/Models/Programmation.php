<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Programmation
 * 
 * @property int $id
 * @property string $name
 * @property Carbon $date_at
 * @property Carbon $started_at
 * @property Carbon|null $ended_at
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Programmation extends Model
{
	use SoftDeletes;

	protected $casts = [
		'date_at' => 'datetime',
		'started_at' => 'datetime',
		'ended_at' => 'datetime'
	];

	protected $guarded = [];
}
