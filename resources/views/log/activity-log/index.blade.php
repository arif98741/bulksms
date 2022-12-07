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
                                    <th>User</th>
                                    <th>Table</th>
                                    <th>Action</th>
                                    <th>Activity</th>
                                    <th>Ip</th>
                                    <th>User Agent</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1?>
                                @foreach($logs  as $ke=> $log)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$log->user_id}}</td>
                                        <td>{{$log->table_name}}</td>
                                        <td>{{$log->action_name}}</td>
                                        <td>{{$log->activity}}</td>
                                        <td>{{$log->ip}}</td>
                                        <td>{{$log->user_agent}}</td>
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
