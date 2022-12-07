<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LongTermServiceRequest;

class LongTermServiceRequestController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Long Term Service Request',
            'requests' => LongTermServiceRequest::orderBy('id', 'desc')->with(['seeker'])->paginate(30),
        ];

       // return $data['requests'];
        return view('backend.long-term-service-process.service-request.index')->with($data);
    }
}
