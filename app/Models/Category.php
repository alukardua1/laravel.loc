<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Category
 *
 * @property mixed|string url
 * @property mixed        title
 * @package App\Models
 */
class Category extends Model
{
	protected $fillable = [
		'title',
		'description',
		'parent_id',
		'url',
	];

	/**
	 * @return BelongsToMany
	 */
	public function getAnime(): BelongsToMany
	{
		return $this->belongsToMany(Anime::class);
	}

	/**
	 * @return HasOne
	 */
	public function getCategory(): HasOne
	{
		return $this->hasOne(__CLASS__, 'id', 'parent_id');
	}

	/*public function getParentId(): HasOne
	{
		return
	}*/
}
