<?php
/*
 * File Created: 3/20/22, 11:06 PM
 * Last Modified: 3/20/22, 11:06 PM
 * File: AuthTrait.php
 * Path: C:/wamp64/www/takecare/app/AppTrait/AuthTrait.php
 * Class: AuthTrait.php
 * Copyright (c) $year
 * Created by Ariful Islam
 * All Rights Preserved By
 * If you have any query then knock me at
 * arif98741@gmail.com
 * See my profile @ https://github.com/arif98741
 */

namespace App\AppTrait;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

trait AuthTrait
{

    /**
     * @return Authenticatable|null
     */
    public static function getUser()
    {
        return Auth::user();
    }

    /**
     * @return mixed
     */
    public static function getUserId()
    {
        return self::getUser()->id;
    }

    /**
     * @return mixed
     */
    public static function getUserRoleId()
    {
        return self::getUser()->role_id;
    }

    /**
     * @param bool $status
     * @return bool
     */
    public static function isProvider(bool $status = false): bool
    {
        $role_id = self::getUser()->role_id;
        if ($role_id == 3) {
            $status = true;
        }
        return $status;
    }

    /**
     * @param bool $status
     * @return bool
     */
    public static function isSeeker(bool $status = false): bool
    {
        $role_id = self::getUser()->role_id;
        if ($role_id == 4) {
            $status = true;
        }
        return $status;
    }
}
