@extends('backend.layout.layout')
@section('title','Tag List')
@section('content')
    <div class="content-header">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i
                            class="fa fa-home"></i>&nbsp;Home</a>
                </li>
                <li class="breadcrumb-item active">Tag List</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tag List</h4>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> Tag Name</th>
                                <th> Status</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $key=> $tag)
                                <tr>
                                    <td>
                                        {{ ++$key }}
                                    </td>
                                    <td>
                                        <label for="" class="badge badge-info"><i class="fa fa-tag"></i>&nbsp; {{ $tag->tag_name }}</label>
                                    </td>

                                    <td>
                                        @if($tag->status == 1)
                                            <i class="ti-check menu-icon text-center"></i> &nbsp; Active
                                        @else
                                            <i class="ti-close menu-icon text-center"></i> &nbsp; Inactive
                                        @endif
                                    </td>
                                    <td>
                                        {{ date('d-m-Y',strtotime( $tag->created_at )) }}
                                    </td>
                                    <td><a href="{{ route('admin.tag.edit',$tag->id) }}"
                                           class="btn-sm btn btn-primary"><i class="fa fa-pencil-alt"></i></a>

                                        <form style="display: inline-block" class="d-none"
                                              action="{{ route('admin.tag.destroy',$tag->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button onclick="return(confirm('are you sure to delete?'))"
                                                    class="btn btn-danger btn-sm" type="submit"><i
                                                    class="fa fa-trash-alt"></i></button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{ $tags->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $('.delete-user').click(function (e) {

            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('Are you sure?')) {
                // Post the form
                $(e.target).closest('form').submit() // Post the surrounding form
            }
        });
    </script>
@endsection
