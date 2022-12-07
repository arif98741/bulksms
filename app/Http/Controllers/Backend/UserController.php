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

use App\Facades\AppFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $users = User::with('role')->whereNotIn('role_id', [1, 2, 5])
            ->where('role_id', $request->role)
            ->with(['speciality'])
            ->when(!empty(request('search')), function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%');
                $q->orWhere('email', '=', $request->search);
                $q->orWhere('phone', '=', $request->search);
            })->when($request->has('status'), function ($q) use ($request) {

                $q->where('status', '=', $request->status);
            });

        $data = [
            'users' => $users->paginate(15),
        ];

        if ($request->role == 3) {

            $data ['title'] = 'Provider List';
            return view('backend.user.provider-index')->with($data);
        }

        $data ['title'] = 'Customer List';
        return view('backend.user.seeker-index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = [
            'roles' => Role::orderBy('name', 'asc')->whereNotIn('id', [1])->get()
        ];
        return view('backend.user.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();


        $data['user_slug'] = Str::slug($request->first_name) . rand(11111, 99999);
        $data['password'] = Hash::make($request->password);
        if (User::create($data)) {

            AppFacade::generateActivityLog('users', 'create', DB::getPdo()->lastInsertId());
            return redirect()->route('backend.user.index', ['role' => $request->role_id])->with(
                [
                    'message' => 'User successfully to system',
                    'alert-type' => 'success'
                ]
            );
        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to store',
                'alert-type' => 'error'
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View|Response
     */
    public function edit(User $user)
    {

        if ($user->role_id == 3) {
            $title = 'Edit provider';
        } else {
            $title = 'Edit customer';
        }

        $data = [
            'roles' => Role::orderBy('name', 'asc')->whereNotIn('id', [1])->get(),
            'user' => $user,
            'title' => $title,
        ];
        return view('backend.user.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->all();

        if ($user->update($data)) {
            AppFacade::generateActivityLog('users', 'update', $user->id);
            return redirect()->route('backend.user.index', ['role' => $user->role_id])->with(
                [
                    'message' => 'User successfully updated',
                    'alert-type' => 'success'
                ]
            );
        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to update user',
                'alert-type' => 'error'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            AppFacade::generateActivityLog('users', 'delete', $user->id);
            return redirect()->route('backend.user.index')->with(
                [
                    'message' => 'User successfully deleted',
                    'alert-type' => 'success'
                ]
            );
        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to delete user',
                'alert-type' => 'error'
            ]
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function userFiles(Request $request, $id)
    {
        $data = [
            'user' => User::where('id', $id)->first(),
            'documents' => User\UserOtherInfo::where('user_id', $id)->get()
        ];

        return view('backend.user.user-files')->with($data);
    }

    public function viewProvider($id)
    {
        $data = [
            'user' => User::where('id', $id)->first(),
            'documents' => User\UserOtherInfo::where('user_id', $id)->get()
        ];

        return view('backend.user.view-provider')->with($data);
    }

    /**
     * Approve Provider Documents
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function changeApproveStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);


        $status = DB::table('users')->where([
            'id' => $id,
        ])->update([
            'documents_verified' => ($request->status == 'approve') ? 1 : 0,
        ]);

        if ($status) {

            AppFacade::generateActivityLog('users', 'users to ' . $request->status, $id);

            return redirect('/backend/user/view-provider/' . $id)->with(
                [
                    'message' => 'Provider document successfully ' . $request->status . 'ed',
                    'alert-type' => 'success'
                ]
            );
        }
    }
}
