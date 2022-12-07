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
use App\Models\ServiceCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ServiceCategoryController extends Controller
{
    public function create()
    {
        $data = [
            'title' => 'Add Service Category',
        ];
        return view('backend.setting.service_category.create')->with($data);
    }
    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(Request $request)
    {
        $service_categories = ServiceCategory::orderby('category_name')
            ->when(!empty(request('search')), function ($q) use ($request) {
                return $q->where('category_name', 'like', '%' . $request->search . '%');
            });

        $data = [
            'service_categories' => $service_categories->get(),
            'service_type' => (\request()->service_type === 'long') ? 'Long' : 'On Demand'
        ];
        return view('backend.setting.service_category.index')->with($data);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'category_name' => 'required|unique:service_categories',
            'service_type' => 'required',
            'service_image' => 'sometimes',
            'start_price' => 'required|numeric',
            'sorting' => 'sometimes|numeric',
        ]);

        if ($request->has('service_image')) {

            $image = ImageHelper::imageUpload($request, 'service_image', 'service_category', true, 600, 600);
            $data['service_image'] = $image['file_path'];
            $data['service_thumbnail'] = $image['thumb_path'];
        }

        if (ServiceCategory::create($data)) {
            AppFacade::generateActivityLog('service_categories', 'create', DB::getPdo()->lastInsertId());
            return redirect()->route('backend.service.service-category.index')->with(
                [
                    'message' => 'Service added successfully to system',
                    'alert-type' => 'success'
                ]
            );

        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to add service category',
                'alert-type' => 'error'
            ]
        );

    }

    public function edit(Request $request,  ServiceCategory  $service_category)
    {
        $data = [
            'service_category' => $service_category,
            'title' => 'Edit Service Category',
        ];
        return view('backend.setting.service_category.edit')->with($data);
    }


    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'category_name' => 'required',
            'start_price' => 'required|numeric',
            'service_type' => 'required',
            'sorting' => 'sometimes|numeric',
        ]);
        $cat = ServiceCategory::find($id);
        $cat->category_name = $request->category_name;
        $cat->start_price = $request->start_price;
        $cat->service_type = $request->service_type;
        if ($request->has('service_image')) {

            $image = ImageHelper::imageUpload($request, 'service_image', 'service_category', true, 600, 600);
            $data['service_image'] = $image['file_path'];
            $data['service_thumbnail'] = $image['thumb_path'];
        }
        if ($cat->update($data)) {
            AppFacade::generateActivityLog('service_categories', 'update', $id);
            return redirect()->route('backend.service.service-category.index')->with(
                [
                    'message' => 'Service updated successfully to system',
                    'alert-type' => 'success'
                ]
            );


        }
        return redirect()->route('backend.service.service-category.index')->with(
            [
                'message' => 'Service update failed',
                'alert-type' => 'error'
            ]
        );
    }

    /**
     * @param ServiceCategory $lab
     * @return RedirectResponse
     */
    public function destroy(ServiceCategory $lab)
    {
        if ($lab->delete()) {
            AppFacade::generateActivityLog('service_categories', 'delete', $lab->id);
            return redirect()->route('admin.setting.service_category.index')->with(['message' => 'ServiceCategory deleted successfully',
                'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => 'Failed to delete lab',
            'alert-type' => 'error']);
    }


}
