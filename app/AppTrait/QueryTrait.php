<?php

namespace App\AppTrait;

use Carbon\Carbon;

trait QueryTrait
{
    /**
     * @param object $q
     * @param string $queryColumn
     * @param string|null $startDate
     * @param string|null $endDate
     * @return object
     */
    public function dateRangeFilter(object $q, string $queryColumn = 'created_at', string $startDate = null, string $endDate = null): object
    {
        $carbon = Carbon::now();
        switch (\request('date_filter')) {
            case 'today':
                return $q->whereRaw("Date($queryColumn) = CURDATE()"); //today
            case 'yesterday':
                return $q->whereRaw("Date($queryColumn) = CURDATE() - INTERVAL 1 DAY"); //yesterday
            case 'last_3':
                return $q->whereBetween($queryColumn, [Carbon::now()->subDays(2), Carbon::now()]);
            case 'last_7':
                return $q->whereBetween($queryColumn, [Carbon::now()->subDays(6), Carbon::now()]);
            case 'last_15':
                return $q->whereBetween($queryColumn, [Carbon::now()->subDays(14), Carbon::now()]);
            case 'this_m':
                return $q->whereBetween($queryColumn, [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ]);
            case 'pre_m':
                return $q->whereBetween($queryColumn, [
                    Carbon::now()->subMonths(1)->startOfMonth(),
                    Carbon::now()->subMonths(1)->endOfMonth()
                ]);
            case 'last_3m':

                return $q->whereBetween($queryColumn, [
                    Carbon::now()->subMonths(2)->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ]);
            case 'custom':
                return $q->whereBetween($queryColumn, [
                    $startDate,
                    $endDate
                ]);
        }
        return $q;
    }
}
