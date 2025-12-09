<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mess
 * 
 * @property int $id
 * @property string $type
 * @property string $fullname
 * @property string|null $email
 * @property string $phone
 * @property string|null $message
 * @property string $request_status
 * @property float $amount
 * @property Carbon $date_at
 * @property Carbon $time_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Mess extends Model
{
	use SoftDeletes;

	protected $casts = [
		'amount' => 'float',
		'date_at' => 'datetime',
		'time_at' => 'datetime'
	];

	protected $guarded = [];
}
