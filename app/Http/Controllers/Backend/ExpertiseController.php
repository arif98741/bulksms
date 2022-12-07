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
use App\Models\Expertise;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class ExpertiseController extends Controller
{
    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View|Collection
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Expertise::orderby('expertise_name')->where('status', 1)->get();
        }

        $expertise = Expertise::orderby('expertise_name')->where('status', 1)
            ->when(!empty(request('search')), function ($q) use ($request) {
                return $q->where('expertise_name', 'like', '%' . $request->search . '%');
            })->when(!empty(request('status')), function ($q) use ($request) {
                return $q->where('status', '=', $request->status);
            });

        $data = [
            'expertises' => $expertise->get(),
        ];
        return view('backend.setting.expertise.index')->with($data);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'expertise_name' => 'required|unique:expertises',
        ]);

        if (Expertise::create($data)) {
            AppFacade::generateActivityLog('expertises', 'create', DB::getPdo()->lastInsertId());
            return response()->json([
                'message' => 'Expertise added successfully',
                'alert-type' => 'success'
            ], 200);

        }

        return response()->json([

            'message' => 'Failed to save',
            'alert-type' => 'error'
        ]);

    }


    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'expertise_name' => 'required',
        ]);

        $cat = Expertise::find($id);
        $cat->expertise_name = $request->expertise_name;


        if ($cat->save($data)) {
            AppFacade::generateActivityLog('expertises', 'update', $id);
            return response()->json([
                'message' => 'Expertise saved successfully',
                'alert-type' => 'success'
            ], 200);

        }

        return response()->json([

            'message' => 'Failed to update',
            'alert-type' => 'error'
        ]);
    }


    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return response()->json([
            'message' => 'Fetched successfully',
            'alert-type' => 'success',
            'data' => Expertise::find($id)
        ], 200);
    }

    /**
     * @param Expertise $lab
     * @return RedirectResponse
     */
    public function destroy(Expertise $lab)
    {

        if ($lab->delete()) {
            AppFacade::generateActivityLog('expertises', 'delete', $lab->id);
            return redirect()->route('admin.setting.expertise.index')->with(['message' => 'Expertise deleted successfully',

                'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => 'Failed to delete lab',

            'alert-type' => 'error']);
    }


}
