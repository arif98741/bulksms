<?php
/*
 *  Project: bulksms
 *  Last Modified: 7/24/22, 6:07 PM
 * File Created: 7/24/22, 6:07 PM
 * File: AccessLogController.php
 * Path: D:/laragon/www/bulksms/app/Http/Controllers/Admin/Log/AccessLogController.php
 * Class: AccessLogController.php
 * Copyright (c) $year
 * Created by Ariful Islam
 *  This file is created and maintained by Ariful Islam. You are not allowed to change or modify any part or fully without My concern. All Rights Preserved By Ariful Islam.
 *  If you have any query then knock me at
 *  arif98741@gmail.com
 *  See my profile @ https://github.com/arif98741
 *
 */

namespace App\Http\Controllers\Backend\Log;

use App\Http\Controllers\Controller;
use App\Models\Backend\ActivityLog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = [
            'logs' => ActivityLog::orderBy('id', 'DESC')->paginate(20),
            'title' => 'User Activity Logs',
        ];

        return view('backend.log.activity-log.index')->with($data);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $coupon = ActivityLog::find($id);
        if ($coupon->delete()) {
            return redirect()->route('admin.user-access-log.index')->with('alert', [
                'type' => 'success',
                'message' => 'Access log deleted from system successfully',
            ]);
        } else {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Fail to Delete Coupon',
            ]);
        }
    }
}
