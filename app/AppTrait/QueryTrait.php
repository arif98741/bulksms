<?php

namespace App\AppTrait;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait QueryTrait
{
    use AuthTrait;

    /**
     * Data Existance Check for Individual User
     * @param string $table
     * @param array $where
     * @return bool
     */
    public function isDataExist(string $table, array $where)
    {
        $where['created_by'] = self::getUserId();
        $count = DB::table($table)->where($where)->count();
        return $count !== 0;
    }

    /**
     * @param object $q
     * @param string $queryColumn
     * @param string|null $startDate
     * @param string|null $endDate
     * @return object
     */
    public function dateRangeFilter(object $q, string $queryColumn = 'created_at', string $startDate = null, string $endDate = null): object
    {
        return match (\request('date_filter')) {
            'today' => $q->whereRaw("Date($queryColumn) = CURDATE()"),
            'yesterday' => $q->whereRaw("Date($queryColumn) = CURDATE() - INTERVAL 1 DAY"),
            'last_3' => $q->whereBetween($queryColumn, [Carbon::now()->subDays(2), Carbon::now()]),
            'last_7' => $q->whereBetween($queryColumn, [Carbon::now()->subDays(6), Carbon::now()]),
            'last_15' => $q->whereBetween($queryColumn, [Carbon::now()->subDays(14), Carbon::now()]),
            'this_m' => $q->whereBetween($queryColumn, [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ]),
            'pre_m' => $q->whereBetween($queryColumn, [
                Carbon::now()->subMonths(1)->startOfMonth(),
                Carbon::now()->subMonths(1)->endOfMonth()
            ]),
            'last_3m' => $q->whereBetween($queryColumn, [
                Carbon::now()->subMonths(2)->startOfMonth(),
                Carbon::now()->endOfMonth()
            ]),
            'custom' => $q->whereBetween($queryColumn, [
                $startDate,
                $endDate
            ]),
            default => $q,
        };
    }
}
