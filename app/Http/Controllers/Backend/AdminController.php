<?php
/*
 * Copyright (c) 2021.
 * This file is originally created and maintained by Ariful Islam.
 * You are not allowed to modify any parts of this code or copy or even redistribute
 * full or small portion to anywhere. If you have any question
 * fee free to ask me at arif98741@gmail.com.
 * Ariful Islam
 * Software Engineer
 * https://github.com/arif98741
 */

namespace App\Http\Controllers\Backend;

use App\AppTrait\SettingTrait;
use App\Http\Controllers\Controller;
use App\Models\Backend\ActivityLog;
use App\Models\Order\ServiceOrder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    use SettingTrait;

    /**
     * @return Application|Factory|View
     */
    public function dashboard()
    {
        $data = [

        ];
        return view('backend.dashboard')->with($data);
    }


}
