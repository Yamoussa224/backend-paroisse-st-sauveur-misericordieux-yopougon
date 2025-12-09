<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TimeSlot
 * 
 * @property int $id
 * @property int $priest_id
 * @property int $weekday
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property bool|null $is_available
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|Listen[] $listens
 *
 * @package App\Models
 */
class TimeSlot extends Model
{
	use SoftDeletes;
	
	protected $casts = [
		'priest_id' => 'int',
		'weekday' => 'int',
		'start_time' => 'datetime',
		'end_time' => 'datetime',
		'is_available' => 'bool'
	];

	protected $guarded = [];

	public function user()
	{
		return $this->belongsTo(User::class, 'priest_id');
	}

	public function listens()
	{
		return $this->hasMany(Listen::class);
	}
}
