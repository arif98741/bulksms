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
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\AppSlider;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AppSliderController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = [
            'app_sliders' => AppSlider::orderby('id', 'desc')->get(),
            'title' => 'App Sliders',
        ];
        return view('backend.setting.app-slider.index')->with($data);
    }

    public function create()
    {

        $data = [
            'title' => 'Add App Slider',
        ];
        return view('backend.setting.app-slider.create')->with($data);
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
            'slider_title' => 'sometimes|unique:app_sliders',
            'slider_description' => 'sometimes',
            'slider_link' => 'sometimes',
            'slider_image' => 'sometimes',
        ]);

        if ($request->hasFile('slider_image')) {
            $file = ImageHelper::imageUpload($request, 'slider_image', 'app_sliders', false, '', '', 'app_slider');
            $data['slider_image'] = $file['file_path'];
        }

        if (AppSlider::create($data)) {
            AppFacade::generateActivityLog('app_sliders','create', DB::getPdo()->lastInsertId());
            return redirect()->route('backend.app-slider.index')->with(
                [
                    'message' => 'App slider added successfully',
                    'alert-type' => 'success'
                ]
            );

        }

        return response()->json([

            'message' => 'Failed to save',
            'alert-type' => 'error'
        ]);

    }

    public function edit(Request $request, AppSlider $app_slider)
    {
        $data = [
            'title' => 'Edit App Slider',
            'app_slider' => $app_slider,
        ];
        return view('backend.setting.app-slider.edit')->with($data);
    }


    /**
     * @param Request $request
     * @param AppSlider $app_slider
     * @return JsonResponse|RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, AppSlider $app_slider)
    {
        $data = $this->validate($request, [
            'slider_title' => 'required|unique:app_sliders,slider_title,' . $app_slider->id,
            'slider_description' => 'sometimes',
            'slider_link' => 'sometimes',
            'slider_image' => 'sometimes',
        ]);

        if ($request->hasFile('slider_image')) {
            if (file_exists($app_slider->slider_image)) {
                unlink($app_slider->slider_image);
            }
            $file = ImageHelper::imageUpload($request, 'slider_image', 'app_sliders', false, '', '', 'app_slider');
            $data['slider_image'] = $file['file_path'];
        }

        if ($app_slider->update($data)) {
            AppFacade::generateActivityLog('app_sliders','update',$app_slider->id);
            return redirect()->route('backend.app-slider.index')->with(
                [
                    'message' => 'App slider updated successfully',
                    'alert-type' => 'success'
                ]
            );
        }

        return response()->json([

            'message' => 'Failed to save',
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
            'data' => AppSlider::find($id)
        ]);
    }

    /**
     * @param AppSlider $app_slider
     * @return RedirectResponse
     */
    public function destroy(AppSlider $app_slider)
    {
        if ($app_slider->delete()) {
            AppFacade::generateActivityLog('app_sliders','delete',$app_slider->id);
            return redirect()->route('backend.app-slider.index')->with(['message' => 'App Slider deleted successfully',
                'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => 'Failed to delete app slider',
            'alert-type' => 'error']);
    }

}
