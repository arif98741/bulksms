<?php
/*
 * File Created: 3/5/22, 12:51 PM
 * Last Modified: 3/5/22, 12:51 PM
 * File: CouponController.php
 * Path: C:/wamp64/www/takecare/app/Http/Controllers/Backend/CouponController.php
 * Class: CouponController.php
 * Copyright (c) $year
 * Created by Ariful Islam
 * All Rights Preserved By
 * If you have any query then knock me at
 * arif98741@gmail.com
 * See my profile @ https://github.com/arif98741
 */

namespace App\Http\Controllers\Backend;

use App\Facades\AppFacade;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;
use Illuminate\View\Factory;

class CouponController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = [
            'coupons' => Coupon::orderBy('created_at', 'desc')->get(),
            'title' => 'Coupons'
        ];

        return view('backend.setting.coupon.index')->with($data);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data = [
            'title' => 'Create Coupon'
        ];
        return view('backend.setting.coupon.create')->with($data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'coupon_code' => 'required|unique:coupons|min:3|max:100',
            'coupon_type' => 'required',
            'coupon_value' => 'required',
            'fixed_minimum' => 'sometimes',
            'percentage_minimum' => 'sometimes',
            'per_day_usage' => 'sometimes',
            'expiration' => 'required',
        ]);

        if (Coupon::create($data)) {
            AppFacade::generateActivityLog('coupons','create',DB::getPdo()->lastInsertId());
            return redirect()->route('backend.coupon.index')->with(
                [
                    'message' => 'Coupon added successfully to system',
                    'alert-type' => 'success'
                ]
            );
        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to add lab',
                'alert-type' => 'error'
            ]
        );
    }

    /**
     * @param Request $request
     * @param Coupon $coupon
     * @return Application|Factory|View
     */
    public function edit(Request $request, Coupon $coupon)
    {
        $data = [
            'coupon' => $coupon,
            'title' => 'Edit Coupon'
        ];
        return view('backend.setting.coupon.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Coupon $coupon
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Coupon $coupon)
    {
        $data = $this->validate($request, [
            'coupon_code' => 'required|min:3|max:12|unique:coupons,coupon_code,' . $coupon->id,
            'coupon_type' => 'required',
            'coupon_value' => 'required',
            'fixed_minimum' => 'sometimes',
            'percentage_minimum' => 'sometimes',
            'per_day_usage' => 'sometimes',
            'expiration' => 'required',
        ]);

        if ($coupon->update($data)) {
            AppFacade::generateActivityLog('coupons','update',$coupon->id);
            return redirect()->route('backend.coupon.index')->with(['message' => 'Coupon updated successfully',
                'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => 'Failed to update coupon',

            'alert-type' => 'error']);
    }

    /**
     * @param Coupon $coupon
     * @return RedirectResponse
     */
    public function destroy(Coupon $coupon)
    {
        if ($coupon->delete()) {
            AppFacade::generateActivityLog('coupons','delete',$coupon->id);
            return redirect()->route('backend.coupon.index')->with(['message' => 'Coupon deleted successfully',
                'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => 'Failed to delete lab',
            'alert-type' => 'error']);
    }

}
