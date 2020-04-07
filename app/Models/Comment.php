<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Comment
 *
 * @package App\Models
 */
class Comment extends Model
{
	protected $fillable = [
		'user_id',
		'anime_id',
		'parent_comment_id',
		'content',
	];

	/**
	 * @return BelongsTo
	 */
	public function getAnime(): BelongsTo
	{
		return $this->belongsTo(Anime::class);
	}

	/**
	 * @return BelongsTo
	 */
	public function getUser(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
}
