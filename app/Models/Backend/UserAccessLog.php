<?php

namespace App\Models\Backend;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\UserAccessLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccessLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccessLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccessLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccessLog sortable($defaultParameters = null)
 * @mixin \Eloquent
 */
class UserAccessLog extends Model
{
    protected $table = 'login_attempts';

    /**
     * @return UserAccessLog[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getAllLog()
    {
        return self::all();
    }

}
