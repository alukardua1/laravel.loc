<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @property int    $id
 * @property string $login
 * @property string $photo
 * @property Group  $getGroup
 * @property int    $age
 * @property mixed  $date_of_birth
 * @property mixed  $created_at
 * @property string $group
 * @property string $register
 *
 * @package App\Models
 * @method static where(string $string, $currentUser)
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login',
        'signature',
        'country_id',
        'photo',
        'allow_email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function getGroup(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function getCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Anime::class, 'favorites')->withTimeStamps();
    }

    /**
     * @return BelongsToMany
     */
    public function vote(): BelongsToMany
    {
        return $this->belongsToMany(Anime::class, 'votes')->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function getAnime(): BelongsToMany
    {
        return $this->belongsToMany(Anime::class);
    }
}
