<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mediation
 * 
 * @property int $id
 * @property string $title
 * @property Carbon $date_at
 * @property string $author
 * @property string $category
 * @property string $mediation_status
 * @property int|null $views
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Mediation extends Model
{
	use SoftDeletes;

	protected $casts = [
		'date_at' => 'datetime',
		'views' => 'int'
	];

	protected $guarded = [];
}
