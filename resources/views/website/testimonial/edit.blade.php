@extends('backend.layout')
@section('title',$title)
@section('breadcrumb_content')
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin Panel</a></li>
            <li class="breadcrumb-item" aria-current="page"><a
                    href="{{ route('backend.testimonial.index') }}">Testimonials</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><span>
              </span>Add Testimonial
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

                            <form action="{{ route('backend.testimonial.update',$testimonial->id) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf @method('put')
                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group ">

                                            <label for="first_name"
                                                   class="text-end control-label col-form-label">Given
                                                By</label>
                                            <input type="text" class="form-control" id="given_by"
                                                   name="given_by"
                                                   placeholder="Enter testimonial author here"
                                                   value="{{ (!empty(old('given_by')) ? old('given_by'): $testimonial->given_by) }}">
                                            @if ($errors->has('given_by'))
                                                <span class="help-block">
                                            <p class="text-red">{{ $errors->first('given_by') }}</p> </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">

                                            <label for="last_name"
                                                   class="text-end control-label col-form-label">Short
                                                Text</label>
                                            <input type="text" class="form-control" id="short_text"
                                                   name="short_text"
                                                   placeholder="Enter short text here"
                                                   value="{{ (!empty(old('short_text')) ? old('short_text'): $testimonial->short_text) }}">
                                            @if ($errors->has('short_text'))
                                                <span class="help-block">
                                            <p class="text-red">{{ $errors->first('short_text') }}</p> </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">

                                            <label for="description"
                                                   class="text-end control-label col-form-label">Testimonial
                                                Text</label>
                                            <textarea name="description" cols="30" rows="4"
                                                      class="form-control">{{ (!empty(old('description')) ? old('description'): $testimonial->description) }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                            <p class="text-red">{{ $errors->first('description') }}</p> </span>
                                            @endif

                                        </div>
                                    </div>


                                </div>


                                <div class="input-group input-group-sm mb-4">

                                    <div class="box-footer text-center">
                                        <a href="{{ route('backend.testimonial.index') }}"
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
