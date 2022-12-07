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
use App\Models\Speciality;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;

class SpecialityController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = [
            'specialities' => Speciality::orderby('speciality_name')->with(['expertise'])->where('status', 1)->get()
        ];

        return view('backend.setting.speciality.index')->with($data);
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
            'speciality_name' => 'required|unique:specialities',
            'expertise_id' => 'required',
        ]);

        if (Speciality::create($data)) {
            AppFacade::generateActivityLog('specialities','create', DB::getPdo()->lastInsertId());
            return response()->json([
                'message' => 'Speciality added successfully',
                'alert-type' => 'success'
            ]);
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
            'speciality_name' => 'required',
            'expertise_id' => 'required',
        ]);

        $expertise = Speciality::find($id);

        $expertise->speciality_name = $request->speciality_name;
        $expertise->expertise_id = $request->expertise_id;


        if ($expertise->save($data)) {
            AppFacade::generateActivityLog('specialities','create', $id);
            return response()->json([
                'message' => 'Speciality updated successfully',
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
            'data' => Speciality::find($id)
        ], 200);
    }

    /**
     * @param Speciality $lab
     * @return RedirectResponse
     */
    public function destroy(Speciality $lab)
    {

        if ($lab->delete()) {
            AppFacade::generateActivityLog('specialities','create', $lab->id);
            return redirect()->route('admin.setting.speciality.index')->with(['message' => 'Speciality deleted successfully',

                'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => 'Failed to delete speciality',

            'alert-type' => 'error']);
    }


}
