<?php

namespace App\Models\Backend;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\ActivityLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog sortable($defaultParameters = null)
 * @mixin Eloquent
 */
class ActivityLog extends Model
{

    protected $table = 'activity_logs';

    /**
     * @return Collection|UserAccessLog[]
     */
    public static function getAllLog()
    {
        return self::all();
    }

}
