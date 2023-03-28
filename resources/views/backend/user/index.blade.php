@extends('backend.layouts.master')
@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>User</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="icon-home"></i></a></li>
                        <h6><a href="" class="btn btn-xs btn-link btn-toggle-fullwidth"></a>
                            Total User : {{App\Models\User::count()}}
                        </h6>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                    <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                        <ul class="breadcrumb">
                            <a href="{{ route('user.create') }}" class="btn btn-info"><i class="icon-plus"></i> Create New User</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>All User</strong> List</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Photo</th>
                                        <th>Full Name</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ $row->photo }}" style="border-radius:50% ; max-height: 60px; max-width: 75px;" alt="user img"></td>
                                        <td>{{ $row->full_name }}</td>
                                        <td>{{ $row->role }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->phone }}</td>
                                        <td>
                                            <input type="checkbox" name="toogle" value="{{ $row->id }}" data-toggle="switchbutton" {{$row->status=='active' ? 'checked' : ''}} data-onlabel="Active" data-offlabel="Inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td class="">
                                            {{-- View --}}
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#userID{{$row->id}}" data-toggle="tooltip" title="View" class="float-legt btn btn-sm btn-outline-secondary" data-placement="bottom"><i class="fas fa-eye"></i></a>
                                            {{-- Edit --}}
                                            <a href="{{ route('user.edit',$row->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                            {{-- Delete --}}
                                            <form class="px-3" onclick="return confirm('Are you sure you want to delete?')" method="POST" action="{{ route('user.destroy', $row->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="userID{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                @php
                                                    $info=App\Models\User::where('id',$row->id)->first();
                                                @endphp
                                                <div class="modal-content">
                                                    <div class="text-center">
                                                        <img src="{{$info->photo}}" style="border-radius: 25%; margin: 5% 0;" alt="user img">
                                                    </div>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Info: {{$info->full_name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>Username:</strong>
                                                        <p>{{$info->username}}</p>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Email:</strong>
                                                                <p>{{$info->email}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Phone</strong>
                                                                <p>{{$info->phone}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Address:</strong>
                                                                <p>{{$info->address}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Status:</strong>
                                                                <p class="badge badge-warning">{{$info->status}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- Status Update Ajax --}}
@section('scripts')
<script>
$('input[name=toogle]').change(function() {
    var mode = $(this).prop('checked');
    var id = $(this).val();
    //alert(id);
    $.ajax({
        url: "{{route('user.status')}}",
        type: "POST",
        data: {
            _token: '{{csrf_token()}}',
            mode: mode,
            id: id,
        },
        success: function(response) {
            if (response.status) {
                alert(response.msg);
            } else {
                alert('Please Try Again!');
            }
        }
    })
});

</script>
@endsection
