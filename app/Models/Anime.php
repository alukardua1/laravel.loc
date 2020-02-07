<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Anime
 *
 * @package App\Models
 */
class Anime extends Model
{
    protected $fillable = [
        'title', 'content'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getCategory(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUsers(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCountry(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * @param $field
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @todo Решить нужна ли эта функция подсчета записей
     *
     */
    public function countAnime($field): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        dd(__METHOD__, $field);
        return $this->hasOne(__CLASS__, $field, $field);
    }
}
