@extends('backend.layout.layout')
@section('title','Group List')
@section('content')
    <div class="content-header">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}"><i
                            class="fa fa-home"></i>&nbsp;Home</a>
                </li>
                <li class="breadcrumb-item active">Group</li>
            </ol>
        </nav>

    </div>

    <div class="container-fluid">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Group</h4>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> Group Name</th>
                                <th>Status</th>
                                <th>Created_at</th>
                                <th>Deleted</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $key=> $group)
                                <tr>
                                    <td>
                                        {{ ++$key }}
                                    </td>
                                    <td>{{ $group->name }}</td>
                                    <td>
                                        @if($group->status == 1)
                                            <span class="badge badge-success text-white">Active</span>
                                            @else
                                            <span class="badge badge-warning text-black">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ date('d-m-Y',strtotime( $group->created_at )) }}
                                    </td>
                                    <td>
                                        @if($group->deleted_at !=null)
                                            <span class="text-green text-center d-block m-0"><i class="fa fa-check"></i></span>
                                            <br>
                                            <span
                                                class="m-0">  {{ date('d-m-Y',strtotime( $group->deleted_at )) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($group->deleted_at == null)
                                            <a href="{{ route('backend.contact.group.edit',$group->id) }}"
                                               class="btn-sm btn btn-primary"><i class="fa fa-pencil-alt"></i></a>

                                            <form style="display: inline-block" class=""
                                                  action="{{ route('backend.contact.group.destroy',$group->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return(confirm('are you sure to delete? after delete this will gone to trash and you can restore it again'))"
                                                        class="btn btn-danger btn-sm" type="submit"><i
                                                        class="fa fa-trash-alt"></i></button>
                                            </form>
                                        @else

                                            <a class="btn btn-sm btn-info"
                                               href="{{ route('backend.contact.group.edit',$group->id) }}"><i
                                                    class="fa fa-undo"></i>&nbsp;Restore</a>
                                        @endif

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
    <script>

        $('.delete-user').click(function (e) {

            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('Are you sure?')) {
                // Group the form
                $(e.target).closest('form').submit() // Group the surrounding form
            }
        });
    </script>
@endsection
