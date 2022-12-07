@extends('backend.layout')
@section('title','')
@section('breadcrumb_content')
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin Panel</a></li>
            <li class="breadcrumb-item" aria-current="page"><a
                    href="{{ route('backend.service.index') }}?service_type={{ request()->get('service_type') }}">Services</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><span>
              </span>Add Service
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div id="content" class="main-content">
        <div class="container-fluid">
            <div class="row layout-spacing mt-2">
                <div class="col-md-12 mb-4">
                    <div class="statbox widget">
                        <div class="widget-content widget-content-area">

                            <form action="{{ route('backend.service.store') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf @method('post')
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">Service
                                                Name</label>
                                            <input type="text" class="form-control" id="service_name"
                                                   name="service_name"
                                                   placeholder="Enter service name"
                                                   value="{{ old('service_name') }}">
                                            @if ($errors->has('service_name'))
                                                <span class="help-block">
                                             <p class="text-red">{{ $errors->first('service_name') }}</p> </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="last_name">Service
                                                Category</label>
                                            <select name="category_id[]" class="form-control select2"
                                                    multiple>

                                                <option value="">Select Category</option>
                                                @foreach($service_categories as $service_category)

                                                    <option
                                                        value="{{ $service_category->id }}">{{ $service_category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="help-block">
                                            <p class="text-red">{{ $errors->first('category_id') }}</p> </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="last_name">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Not Active</option>
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="help-block">
                                            <p class="text-red">{{ $errors->first('category_id') }}</p> </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-md-6  @if($service_type == 'Long') d-none @endif">
                                        <div class="form-group ">
                                            <label for="first_name">Service
                                                Price</label>
                                            <input type="number" class="form-control text-right" id="price"
                                                   name="price"
                                                   placeholder="Enter price here"
                                                   value="{{ !empty(old('price')) ? old('price'): 0 }}">
                                            @if ($errors->has('price'))
                                                <span class="help-block">
                                            <p class="text-red">{{ $errors->first('price') }}</p> </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-6 d-none">
                                        <div class="form-group ">

                                            <label for="first_name">Service
                                                Type</label>
                                            <select name="service_type" id="service_type" readonly=""
                                                    class="form-control">
                                                <option value="">Select Type</option>
                                                <option value="short"
                                                        @if(request()->get('service_type') =='short') selected @endif>
                                                    On Demand(Short)
                                                </option>
                                                <option value="long"
                                                        @if(request()->get('service_type') =='long') selected @endif>
                                                    Long
                                                </option>
                                            </select>
                                            @if ($errors->has('service_type'))
                                                <span class="help-block">
                                            <p class="text-red">{{ $errors->first('service_type') }}</p> </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">

                                            <label for="service_image">Service
                                                Image</label>
                                            <input type="file" class="form-control text-right"
                                                   name="service_image"
                                                   placeholder="Enter price here"
                                                   value="{{ old('service_image') }}">
                                            @if ($errors->has('service_image'))
                                                <span class="help-block">
                                            <p class="text-red">{{ $errors->first('service_image') }}</p> </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">

                                            <label for="first_name"
                                                   class="text-end control-label col-form-label">Sorting</label>
                                            <input type="number" class="form-control" id="sorting"
                                                   name="sorting"
                                                   placeholder="Enter sorting"
                                                   value="{{ old('sorting') }}">
                                            @if ($errors->has('sorting'))
                                                <span class="help-block">
                                            <p class="text-red">{{ $errors->first('sorting') }}</p> </span>
                                            @endif
                                        </div>
                                    </div>


                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group ">

                                            <label for="description"
                                                   class="text-end control-label col-form-label">Description</label>
                                            <textarea name="description" id="" cols="30" rows="4"
                                                      class="form-control">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                            <p class="text-red">{{ $errors->first('description') }}</p> </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="input-group input-group-sm mb-4">

                                    <div class="box-footer text-center">
                                        <a href="{{ route('backend.service.index') }}?service_type={{ request()->get('service_type') }}"
                                           type="button"
                                           class="btn btn-default">Back</a>
                                        <button type="submit" class="btn btn-primary">Submit
                                        </button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        @push('css')
            <link rel="stylesheet" href="{{ asset('backend/plugins/select2/select2.min.css') }}">
            <style>
                .select2-container--default .select2-selection--multiple .select2-selection__choice {
                    background-color: #2255a4;
                    border-color: #2255a4;
                    color: #fff;
                }
            </style>

        @endpush

        @push('script')
            <script src="{{ asset('backend/plugins/select2/select2.min.js') }}"></script>
            <script>
                $('document').ready(function () {
                    $('.select2').select2();
                });
            </script>
    @endpush

@endsection
