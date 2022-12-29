@extends('backend.layout.layout')
@section('title',$title)
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i
                                    class="fa fa-home"></i>&nbsp;@lang('Home')</a>
                        </li>
                        <li class="breadcrumb-item "><a
                                href="{{ route('backend.contact.group.index') }}">@lang('Groups')</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('backend.contact.group.index') }}" class="btn btn-primary btn-sm float-sm-right">@lang('Back to Groups')</a>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form id="postFormSubmit" class="forms-sample" action="{{ route('backend.contact.group.store') }}"
                      enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('post')

                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input name="name" type="text" id="title" class="form-control"
                                               value="{{ old('name') }}"
                                               placeholder="@lang('Group Name')">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('name') }}</p></span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                       <div class="col-md-2">
                           <button type="submit" class="btn btn-success btn-save mr-2">@lang('Save')</button>
                           <a href="{{ route('backend.contact.group.index') }}" class="btn btn-info">@lang('Back')</a>
                       </div>
                    </div>
                </form>
            </div>




        </div>
    </div>

    </div>

    @push('extra-css')

    @endpush
    @push('extra-script')

        <script>
            $(document).ready(function () {


            });
        </script>
    @endpush
@endsection
