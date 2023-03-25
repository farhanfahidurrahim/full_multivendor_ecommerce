@extends('backend.layouts.master')
@section('content')
	
	<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Library</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Library</li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#00c5dc"
                                data-fill-Color="transparent">3,5,1,6,5,4,8,3</div>
                            <span>Visitors</span>
                        </div>
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#f4516c"
                                data-fill-Color="transparent">4,6,3,2,5,6,5,4</div>
                            <span>Visits</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Banner</strong> List</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Photo</th>
                                            <th>Condition</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>                            
                                    <tbody>
                                    	@foreach($data as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->title }}</td>
                                            <td>{{ $row->description }}</td>
                                            <td><img src="{{ $row->photo }}" style="max-height: 90px; max-width: 128px;" alt="banner img"></td>
                                            <td>
                                            	@if($row->condition=='banner')
                                            		<span class="badge badge-success">{{ $row->condition }}</span>
                                            	@else
                                            		<span class="badge badge-primary">{{ $row->condition }}</span>	
                                            	@endif
                                            </td>
                                            <td>
                                            	<input type="checkbox" name="toogle" value="{{ $row->id }}" data-toggle="switchbutton" {{$row->status=='active' ? 'checked' : ''}} data-onlabel="Active" data-offlabel="Inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                            </td>
                                            <td>
                                            	<a href="" data-toggle="tooltip" title="edit" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                            	<a href="" data-toggle="tooltip" title="delete" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
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

        </div>
    </div>

@endsection

@section('scripts')
	<script>
		$('input[name=toogle]').change(function(){
			var mode=$(this).prop('checked');
			var id=$(this).val();
			//alert(id);
			$.ajax({
				url:"{{route('banner.status')}}",
				type:"POST",
				data:{
					_token:'{{csrf_token()}}',
					mode:mode,
					id:id,
				},
				success:function(response){
					if(response.status)
					{
						alert(response.msg);
					}
					else{
						alert('Please Try Again!');
					}
				}
			})
		});
	</script>
@endsection