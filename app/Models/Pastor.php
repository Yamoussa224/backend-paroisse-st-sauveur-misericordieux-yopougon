<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pastor
 * 
 * @property int $id
 * @property string $fullname
 * @property Carbon $started_at
 * @property Carbon|null $ended_at
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Pastor extends Model
{
	use SoftDeletes;

	protected $guarded = [];
}
