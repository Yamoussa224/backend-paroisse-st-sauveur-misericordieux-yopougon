<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Service
 * 
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $image
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Service extends Model
{
	use SoftDeletes;

	protected $guarded = [];
}
