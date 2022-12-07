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

use App\AppTrait\AuthTrait;
use App\Facades\AppFacade;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceCats;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ServiceController extends Controller
{
    use AuthTrait;

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $service = Service::with(['service_cats.service_category'])->orderby('service_name')
            ->when(!empty(request('search')), function ($q) use ($request) {
                return $q->where('service_name', 'like', '%' . $request->search . '%');
            })->when(!empty(request('status')), function ($q) use ($request) {
                return $q->where('status', '=', $request->status);
            });

        if ($request->has('service_type')) {
            $service->where('service_type', $request->service_type);
        }

        $data = [
            'services' => $service->paginate(15),
            'service_type' => (\request()->service_type === 'long') ? 'Long' : 'On Demand'
        ];

        return view('backend.service.index')->with($data);
    }

    /**
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function create(Request $request)
    {
        try {
            $data = [
                'service_categories' => ServiceCategory::orderby('category_name')
                    ->where('service_type', \request()->get('service_type'))
                    ->get(),
                'service_type' => (\request()->service_type === 'long') ? 'Long' : 'On Demand'
            ];
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            throw new \RuntimeException($e->getMessage());
        }
        return view('backend.service.create')->with($data);
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
            'category_id' => 'required',
            'price' => 'required',
            'service_type' => 'required',
            'description' => 'required',
            'sorting' => 'required',
            'status' => 'required',
            'service_image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048', //max 2MB

        ]);
        unset($data['category_id']);

        if (!empty($request->file('service_image'))) {
            $image = ImageHelper::imageUpload($request, 'service_image', 'service', true);
            $data['service_image'] = $image['filename'];
            $data['service_image_thumbnail'] = $image['thumb_path'];
            $data['image_path'] = $image['file_path'];
        }

        if ($service = Service::create($data)) {

            AppFacade::generateActivityLog('services', 'create', DB::getPdo()->lastInsertId());
            foreach ($request->category_id as $category) {
                ServiceCats::create([
                    'service_id' => $service->id,
                    'category_id' => $category,
                    'created_by' => self::getUserId(),
                    'updated_by' => self::getUserId(),
                ]);
                AppFacade::generateActivityLog('service_cats', 'create', DB::getPdo()->lastInsertId());
            }
            return redirect('backend/service/?service_type=' . $request->service_type)->with(
                [
                    'message' => 'Service added successfully to system',
                    'alert-type' => 'success'
                ]
            );
        }

        return redirect('backend/service/?service_type=' . $request->service_type)->with(
            [
                'message' => 'Failed to add service',
                'alert-type' => 'error'
            ]
        );
    }

    /**
     * @param Request $request
     * @param Service $service
     * @return Application|Factory|View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function edit(Request $request, Service $service)
    {

        $data = [
            'service' => $service,
            'service_cats' => ServiceCats::where('service_id', $service->id)->get()->pluck('category_id')->toArray(),
            'service_categories' => ServiceCategory::orderby('category_name')
                ->where('service_type', \request()->get('service_type'))
                ->get(),
            'service_type' => (\request()->service_type === 'long') ? 'Long' : 'On Demand'

        ];

        return view('backend.service.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Service $service
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Service $service)
    {
        $data = $this->validate($request, [
            'service_name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'sorting' => 'required',
            'service_image' => 'sometimes|image|mimes:jpg,jpeg,png,gif,svg|max:2048', //max 2MB
        ]);


        if ($request->hasFile('service_image')) {

            if (file_exists(public_path('uploads/service/' . $service->service_image))) {
                unlink(public_path('uploads/service/' . $service->service_image));
            }
            $image = ImageHelper::imageUpload($request, 'service_image', 'service', true);
            $data['service_image'] = $image['filename'];
            $data['service_image_thumbnail'] = $image['thumb_path'];
            $data['image_path'] = $image['file_path'];
        }

        unset($data['category_id']);
        if ($service->update($data)) {

            AppFacade::generateActivityLog('services', 'update', $service->id);

            ServiceCats::where([
                'service_id' => $service->id
            ])->delete();

            foreach ($request->category_id as $category) {
                ServiceCats::create([
                    'service_id' => $service->id,
                    'category_id' => $category,
                    'updated_by' => self::getUserId(),
                ]);
                AppFacade::generateActivityLog('service_cats', 'create', DB::getPdo()->lastInsertId());
            }

            return redirect('backend/service/?service_type=' . $request->service_type)
                ->with([
                    'message' => 'Service updated successfully',
                    'alert-type' => 'success',
                ]);
        }
        return redirect()->back()->with([
            'message' => 'Failed to update service',
            'alert-type' => 'error'
        ]);
    }

    /**
     * @param Request $request
     * @param Service $service
     * @return RedirectResponse
     */
    public function destroy(Request $request, Service $service)
    {
        if (file_exists(public_path('uploads/service/' . $service->service_image))) {
            unlink(public_path('uploads/service/' . $service->service_image));
        }

        if ($service->delete()) {
            AppFacade::generateActivityLog('services', 'delete', $service->id);
            return redirect('backend/service/?service_type=' . $request->service_type)
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
