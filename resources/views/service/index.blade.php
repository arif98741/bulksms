@extends('backend.layout')
@section('title','Service List')
@section('breadcrumb_content')
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin Panel</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>{{ $service_type }} Services
                </span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="">{{ $service_type }} Service List</h5>
                        </div>
                        <div class="col-md-9">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-row table-data-search-form">

                                            <input type="text" name="search"
                                                   value="{{ (isset($_GET['search'])) ? $_GET['search']: '' }}"
                                                   placeholder="Service name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="active" @if(request()->has('status') && request()->get('status') =='active') selected @endif>Active</option>
                                            <option value="inactive" @if(request()->has('status') && request()->get('status') =='inactive') selected @endif>Not Active</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="hidden" name="service_type"
                                               value="{{ request()->get('service_type') }}">
                                        <button type="submit" class="btn btn-success" style="margin: 0px;
    padding: 10px 27px;">
                                            <i class="fa-solid fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>

                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table
                                id="zero_config"
                                class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Service Name</th>
                                    <th>Image</th>
                                    <th>Sort Order</th>

                                    @if($service_type != 'Long')
                                        <th>Price</th>
                                    @endif
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Update Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($services as $key=> $service)

                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $service->service_name }}</td>
                                        <td>
                                            @if(file_exists( $service->service_image_thumbnail ))

                                                <img src="{{ asset($service->service_image_thumbnail) }}"
                                                     style="width: 80px; height: 80px;" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $service->sorting }}</td>
                                        <td class="d-none">

                                            @if($service->service_cats->count() > 0)

                                                <ul class="list-group">


                                                    @foreach($service->service_cats as $service_category)

                                                        <li class=""><label
                                                                class=""> <i
                                                                    class="mdi mdi-briefcase"></i> {{ $service_category->service_category->category_name }}
                                                                <br></label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </td>

                                        @if($service_type != 'Long')
                                            <td class="text-center">{{ $service->price }}</td>
                                        @endif
                                        <td>{{ $service->status }} </td>
                                        <td>{{ date('d-m-Y',strtotime($service->created_at)) }}</td>
                                        <td>{{ date('d-m-Y',strtotime($service->updated_at)) }}</td>
                                        <td>
                                            <a href="{{ route('backend.service.edit',$service->id) }}?{{ request()->getQueryString() }}"><i
                                                    class="fa fa-edit"></i></a>
                                            <form method="POST"
                                                  action="{{ route('backend.service.destroy',$service->id) }}?{{ request()->getQueryString() }}"
                                                  style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-delete-user"><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>

                            </table>
                            {{ $services->appends($_GET)->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('backend.lib.footer-copyright')
    </div>
@endsection
