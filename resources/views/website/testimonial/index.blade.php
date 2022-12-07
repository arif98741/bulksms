@extends('backend.layout')
@section('title',$title)
@section('breadcrumb_content')
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin Panel</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}
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
                            <h5 class="">{{ $title }} </h5>
                        </div>
                        <div class="col-md-9">
                            <form action="{{ url()->current() }}">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group form-row table-data-search-form">

                                            <input type="text" name="search"
                                                   value="{{ (isset($_GET['search'])) ? $_GET['search']: '' }}"
                                                   placeholder="title" class="form-control">
                                        </div>
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
                                    <th>Given By</th>
                                    <th>Short Text</th>
                                    <th>Description</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($testimonials as $key=> $testimonial)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $testimonial->given_by }}</td>
                                        <td>{{ $testimonial->short_text }}</td>
                                        <td>{{ substr( $testimonial->description, 0, 40)  }}</td>

                                        <td>{{ date('d-m-Y',strtotime($testimonial->created_at)) }}</td>
                                        <td>{{ date('d-m-Y',strtotime($testimonial->updated_at)) }}</td>
                                        <td>
                                            <a href="{{ route('backend.testimonial.edit',$testimonial->id) }}"
                                               class="btn btn-primary">Edit</a>
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('backend.lib.footer-copyright')
    </div>
@endsection
