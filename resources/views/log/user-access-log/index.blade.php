@extends('backend.layout')
@section('title',$title)
@section('breadcrumb_content')
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin Panel</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }} </span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="widget-heading">
                                <h5 class="">{{ $title }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>User ID</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Ip</th>
                                    <th>User Agent</th>
                                    <th>Login Status</th>
                                    <th>Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1?>
                                @foreach($logs  as $ke=> $log)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$log->user_id}}</td>
                                        <td>{{$log->email}}</td>
                                        <td>{{$log->name}}</td>
                                        <td>{{$log->ip}}</td>
                                        <td>{{$log->user_agent}}</td>
                                        <td>
                                            @if($log->login_status == 1)
                                                <label for="" class="badge badge-success">success</label>
                                            @else
                                                <label for="" class="badge badge-danger">failed</label>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::make($log->created_at)->format('H:i:sA, Y-m-d') }}</td>


                                        <td class="text-center">
                                            <div class="dropdown custom-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-more-horizontal">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="19" cy="12" r="1"></circle>
                                                        <circle cx="5" cy="12" r="1"></circle>
                                                    </svg>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">

                                                    <form method="POST"
                                                          action="{{ route('backend.user-access-log.destroy', $log->id) }}"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="dropdown-item" type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $logs->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('backend.lib.footer-copyright')
    </div>
@endsection
