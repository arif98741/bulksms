<?php
/*
 * File Created: 2/20/22, 12:13 AM
 * Last Modified: 2/20/22, 12:13 AM
 * File: TestimonialController.php
 * Path: C:/wamp64/www/takecare/app/Http/Controllers/Backend/Website/TestimonialController.php
 * Class: TestimonialController.php
 * Copyright (c) $year
 * Created by Ariful Islam
 * All Rights Preserved By
 * If you have any query then knock me at
 * arif98741@gmail.com
 * See my profile @ https://github.com/arif98741
 */

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TestimonialController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data = [
            'testimonials' => Testimonial::orderBy('id', 'desc')->get(),
            'title' => 'Testimonials',
        ];
        return view('backend.website.testimonial.index')->with($data);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = [
            'title' => 'Create Testimonial',
        ];
        return view('backend.website.testimonial.create')->with($data);
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
            'given_by' => 'required',
            'short_text' => 'sometimes',
            'description' => 'required',
        ]);

        if (Testimonial::create($data)) {
            return redirect()->route('backend.testimonial.index')->with(
                [
                    'message' => 'Testimonial successfully added to the system',
                    'alert-type' => 'success'
                ]
            );

        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to add testimonial',
                'alert-type' => 'error'
            ]
        );

    }

    /**
     * @return Application|Factory|View
     */
    public function edit(Request $request, Testimonial $testimonial)
    {
        $data = [
            'testimonial' => $testimonial,
            'title' => 'Edit Testimonial',
        ];

        return view('backend.website.testimonial.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Testimonial $testimonial
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $this->validate($request, [
            'given_by' => 'required',
            'short_text' => 'sometimes',
            'description' => 'required',
        ]);

        if ($testimonial->update($data)) {
            return redirect()->route('backend.testimonial.index')->with(
                [
                    'message' => 'Testimonial successfully update to the system',
                    'alert-type' => 'success'
                ]
            );

        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to update testimonial',
                'alert-type' => 'error'
            ]
        );

    }
}
