<?php

namespace App\Http\Controllers\Backend\Contact;

use App\Facades\AppFacade;
use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ContactGroupController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = [
            'groups' => Group::where('created_by', self::getUserId())->orderBy('created_at', 'desc')->get(),
            'title' => 'Groups'
        ];

        return view('backend.contact.group.index')->with($data);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = [
            'title' => 'Create Contact Group'
        ];
        return view('backend.contact.group.create')->with($data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|min:3|max:50',
        ], [
            'name.required' => 'The group name field is required.',
            'name.min' => 'The group name field should be at least 3 characters',
            'name.max' => 'The group name field should not contain more than 5 characters.',
        ]);

        if ($this->isDataExist('groups', ['name' => $request->name])) {
            return redirect()->route('backend.contact.group.create')->with(
                [
                    'message' => 'Group already exist',
                    'type' => 'error'
                ]
            );
        }
        $data['created_by'] = self::getUserId();

        if (Group::create($data)) {
            AppFacade::generateActivityLog('groups', 'create', DB::getPdo()->lastInsertId());
            return redirect()->route('backend.contact.group.index')->with([
                'message' => 'Group added successfully to system',
                'type' => 'success',
            ]);
        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to add group',
                'type' => 'error'
            ]
        );
    }

    /**
     * @param Request $request
     * @param Group $group
     * @return Application|Factory|View
     */
    public function edit(Request $request, Group $group)
    {
        $data = [
            'coupon' => $group,
            'title' => 'Edit Group'
        ];
        return view('backend.setting.coupon.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Group $group
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Group $group)
    {
        $data = $this->validate($request, [
            'coupon_code' => 'required|min:3|max:12|unique:coupons,coupon_code,' . $group->id,
            'coupon_type' => 'required',
            'coupon_value' => 'required',
            'fixed_minimum' => 'sometimes',
            'percentage_minimum' => 'sometimes',
            'per_day_usage' => 'sometimes',
            'expiration' => 'required',
        ]);

        if ($group->update($data)) {
            AppFacade::generateActivityLog('coupons', 'update', $group->id);
            return redirect()->route('backend.coupon.index')->with(['message' => 'Group updated successfully',
                'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => 'Failed to update coupon',

            'alert-type' => 'error']);
    }

    /**
     * @param Group $group
     * @return RedirectResponse
     */
    public function destroy(Group $group)
    {
        if ($group->delete()) {
            AppFacade::generateActivityLog('groups', 'delete', DB::getPdo()->lastInsertId());
            return redirect()->route('backend.contact.group.index')->with([
                'message' => 'Group successfully deleted',
                'type' => 'success',
            ]);
        }
        return redirect()->back()->with(
            [
                'message' => 'Failed to delete group',
                'type' => 'error'
            ]
        );
    }

}
