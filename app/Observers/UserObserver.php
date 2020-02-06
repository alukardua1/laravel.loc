<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Observers;

use App\Models\User;
use Composer\DependencyResolver\Request;

/**
 * Class UserObserver
 *
 * @package App\Observers
 */
class UserObserver
{
    /**
     * @param  \App\Models\User  $user Updating user
     */
    public function updating(User $user)
    {
        $user['allow_email'] = request()->allow_email ? true : false;
    }
}
