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
use App\Models\FrontService;
use App\Models\ServiceCategory;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class FrontServiceController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $service = FrontService::orderBy('service_name', 'asc')
            ->when(!empty(request('search')), function ($q) use ($request) {
                return $q->where('service_name', 'like', '%' . $request->search . '%');
            })->when(!empty(request('status')), function ($q) use ($request) {
                return $q->where('status', $request->status);
            });
        $data = [
            'services' => $service->paginate(15),
            'title' => 'Front Services',
        ];

        return view('backend.front-service.index')->with($data);
    }

    /**
     * @return Application|Factory|View
     * @throws Exception
     */
    public function create(Request $request)
    {
        try {
            $data = [
                'service_categories' => ServiceCategory::orderby('category_name')
                    ->where('service_type', \request()->get('service_type'))
                    ->get()
            ];
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            throw new Exception($e->getMessage());
        }
        $data['title'] = 'Create Front Service';
        return view('backend.front-service.create')->with($data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'service_name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'service_image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:4096', //max 2MB
        ]);

        //    $image = $request->file('service_image');
        if (!empty($request->file('service_image'))) {

            $image = ImageHelper::imageUpload($request, 'service_image', 'front_service', true);
            $data['service_image'] = $image['filename'];
            $data['service_image_thumbnail'] = $image['thumb_path'];
            $data['image_path'] = $image['file_path'];
        }

        if (FrontService::create($data)) {
            AppFacade::generateActivityLog('front_services', 'create', DB::getPdo()->lastInsertId());
            return redirect()->route('backend.front-service.index')->with(
                [
                    'message' => 'Front service added successfully to system',
                    'alert-type' => 'success'
                ]
            );
        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to add service',
                'alert-type' => 'error'
            ]
        );
    }

    /**
     * @param Request $request
     * @param FrontService $front_service
     * @return Application|Factory|View
     */
    public function edit(Request $request, FrontService $front_service)
    {
        $data = [
            'service' => $front_service,
            'title' => 'Edit Front Service',
        ];
        return view('backend.front-service.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param FrontService $front_service
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, FrontService $front_service)
    {
        $data = $this->validate($request, [
            'service_name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'service_image' => 'sometimes|image|mimes:jpg,jpeg,png,gif,svg|max:2048', //max 2MB
        ]);

        if ($request->hasFile('service_image')) {

            if (file_exists(public_path('uploads/front_service/' . $front_service->service_image))) {
                unlink(public_path('uploads/front_service/' . $front_service->service_image));
            }
            $image = ImageHelper::imageUpload($request, 'service_image', 'front_service', true);
            $data['service_image'] = $image['filename'];
            $data['service_image_thumbnail'] = $image['thumb_path'];
            $data['image_path'] = $image['file_path'];
        }

        if ($front_service->update($data)) {

            AppFacade::generateActivityLog('front_services', 'update', $front_service->id);
            return redirect()->route('backend.front-service.index')->with(
                [
                    'message' => 'Front service update successfully',
                    'alert-type' => 'success'
                ]
            );
        }
        return redirect()->back()->with([
            'message' => 'Failed to update front service',
            'alert-type' => 'error'
        ]);
    }

    /**
     * @param Request $request
     * @param FrontService $front_service
     * @return RedirectResponse
     */
    public function destroy(Request $request, FrontService $front_service)
    {
        if (file_exists(storage_path('uploads/front_service/' . $front_service->service_image))) {
            unlink(storage_path('uploads/front_service/' . $front_service->service_image));
        }

        if ($front_service->delete()) {
            AppFacade::generateActivityLog('front_services', 'delete', $front_service->id);
            return redirect()->route('backend.front-service.index')
                ->with([
                    'message' => 'Service deleted successfully',
                    'alert-type' => 'success',
                ]);
        }

        return redirect()->back()->with([
            'message' => 'Failed to delete service',
            'alert-type' => 'error'
        ]);
    }
}
