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

use App\Exports\Customer\CustomerListExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $users = User::Sorting($request->sort)->where('role_id', 4)
            ->when(!empty(request('search')), function ($q) use ($request) {
                $q->Where('full_name', 'like', '%' . $request->search . '%');
                $q->orWhere('email', '=', $request->search);
                $q->orWhere('phone', '=', $request->search);
            })->when(!empty(request('status')), function ($q) use ($request) {
                $q->Where('status', '=', $request->search);
            });

        $data = [
            'users' => $users->paginate(20),
            'title' => 'Customers',
        ];


        return view('backend.customer.index')->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $data = [
            'roles' => Role::orderBy('name', 'asc')->whereNotIn('id', [1])->get(),
            'title' => 'Create Customer',
        ];
        return view('backend.customer.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'full_name' => 'required',
            'password' => 'required|min:6|max:20',
            'email' => 'email|required|unique:users',
            'phone' => 'unique:users|min:6|max:15',
            'otp_verified' => 'required',
            'status' => 'required',
        ]);

        $data['role_id'] = 4;
        $data['user_slug'] = Str::slug($request->first_name) . rand(11111, 99999);
        $data['password'] = Hash::make($request->password);
        if (User::create($data)) {

            return redirect()->route('backend.customer.index', ['role' => $request->role_id])->with(
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
     * @param User $customer
     * @return Application|Factory|View
     */
    public function edit(User $customer)
    {

        $data = [
            'user' => $customer,
            'title' => 'Edit customer',
        ];
        return view('backend.customer.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param User $customer
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, User $customer): RedirectResponse
    {
        $data = $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'phone' => 'required|unique:users,phone,' . $customer->id,
            'otp_verified' => 'required',
            'status' => 'required',
        ]);

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($customer->update($data)) {
            return redirect()->route('backend.customer.index')->with(
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
     * @param User $customer
     * @return RedirectResponse
     */
    public function destroy(User $customer)
    {
        if ($customer->delete()) {
            return redirect()->route('backend.customer.index')->with(
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

        return view('backend.customer.user-files')->with($data);
    }

    /**
     * @return void
     */
    public function downloadCustomerData(Request $request)
    {
        $filename = 'customer_' . Carbon::now()->format('Y-m-d h:i:sA');

        if ($request->type === 'excel') {

            return (new CustomerListExport($request))->download($filename . '.xlsx');
        }

        if ($request->type === 'pdf') {

            $starting = $request->starting;
            $ending = $request->ending;

            $data = [
                'users' => User::where('created_at', '>=', $starting)
                    ->where('created_at', '<=', $ending)
                    ->where('role_id', 4)
                    ->select('full_name', 'phone', 'gender', 'created_at')
                    ->orderBy('full_name', 'asc')
                    ->get(),
                'starting' => $starting,
                'ending' => $ending,
            ];
            return PDF::loadView('backend.customer.report.customer-data', $data)->stream($filename . '.pdf');
        }
    }
}
