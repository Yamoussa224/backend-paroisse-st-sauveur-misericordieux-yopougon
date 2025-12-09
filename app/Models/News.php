<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class News
 * 
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string $category
 * @property string $new_status
 * @property int|null $views
 * @property Carbon $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class News extends Model
{
	use SoftDeletes;

	protected $casts = [
		'views' => 'int',
		'published_at' => 'datetime'
	];

	protected $guarded = [];
}
