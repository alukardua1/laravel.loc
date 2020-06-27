<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Anime
 *
 * @property int                id
 * @property string             title
 * @property string             url
 * @property string             day
 * @property mixed              delivery_time
 * @property string             seasons
 * @property mixed              aired_on
 * @property string             poster
 * @property bool|mixed         posted_at
 * @property mixed|string       description
 * @property false|mixed|string keywords
 * @property mixed|string       metatitle
 * @property mixed|string       aired_season
 * @property mixed              content
 *
 * @package App\Models
 * @method static create($requestForm)
 * @method static where(string $string, $id)
 * @method first()
 */
class Anime extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = [
		'title',
		'content',
		'poster',
		'wa_id',
		'shikimori_id',
		'kp_id',
		'mal_id',
		'anidb_id',
		'japanese',
		'english',
		'romaji',
		'url',
		'delivery_time',
		'tv_canal',
		'tip',
		'count_series',
		'duration',
		'aired_on',
		'released_on',
		'rating',
		'country_id',
		'video',
		'user_id',
		'posted_at',
		'released',
		'current_series',
	];

	/**
	 * @return BelongsToMany
	 */
	public function getCategory(): BelongsToMany
	{
		return $this->belongsToMany(Category::class);
	}

	/**
	 * @return BelongsTo
	 */
	public function getUsers(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	/**
	 * @return BelongsTo
	 */
	public function getCountry(): BelongsTo
	{
		return $this->belongsTo(Country::class, 'country_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getTranslate(): BelongsToMany
	{
		return $this->belongsToMany(Translate::class);
	}

	/**
	 * @param $field
	 *
	 * @return HasOne
	 * @todo Решить нужна ли эта функция подсчета записей
	 *
	 */
	public function countAnime($field): HasOne
	{
		return $this->hasOne(__CLASS__, $field, $field);
	}

	/**
	 * @return bool
	 */
	public function favorited(): bool
	{
		return (bool)$this->hasMany(Favorites::class)
			->where('user_id', Auth::id())
			->where('anime_id', $this->id)
			->first();
	}

	/**
	 * @return bool
	 */
	public function votes(): bool
	{
		return (bool)$this->hasMany(Vote::class)
			->where('user_id', Auth::id())
			->where('anime_id', $this->id)
			->first();
	}

	/**
	 * @return HasMany
	 * @todo Найти применение
	 */
	public function voteCount(): HasMany
	{
		return $this->hasMany(Vote::class, 'anime_id');
	}

	/**
	 * @return HasMany
	 */
	public function commentsCount(): HasMany
	{
		return $this->hasMany(Comment::class)
			->selectRaw('anime_id, count(*) as aggregate')
			->groupBy('anime_id');
	}
}
