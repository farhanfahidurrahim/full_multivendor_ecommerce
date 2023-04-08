@extends('seller.layouts.master')
@section('content')

	<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Add New Product</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href=""><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Product</li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <ul class="breadcrumb">
                                <a href="{{ route('product.index') }}" class="btn btn-info"><i class="icon-home"></i> All Product List</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                        	<form action="{{ route('seller-product.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                                <div class="row clearfix">

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <input type="text" class="form-control" name="title" value="{{ $data->title }}" placeholder="Title">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <label for="">Summary</label>
                                        <div class="form-group">
                                            <textarea id="summary" class="form-control" name="summary" placeholder="Write some text">{{ $data->summary }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <label for="">Description</label>
                                        <div class="form-group">
                                            <textarea id="description" class="form-control" name="description" placeholder="Write some text">{{ $data->description }}</textarea>
                                        </div>
                                    </div>

                                    {{-- <div class="col-lg-12 col-md-12">
                                        <label for="">Image Upload</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ $data->photo }}">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    </div> --}}

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Stock</label>
                                            <input type="number" class="form-control" name="stock" value="{{ $data->stock }}" placeholder="Stock">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Price</label>
                                            <input type="number" class="form-control" name="price" value="{{ $data->price }}" placeholder="Price">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Discount (%)</label>
                                            <input type="number" min="0" max="99" class="form-control" name="discount" value="{{ $data->discount }}" placeholder="Discount">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="">Brand</label>
                                        <select class="form-control show-tick" name="brand_id">
                                            <option selected disabled value="">-- Choose --</option>
                                            @foreach (App\Models\Brand::get() as $row)
                                                <option value="{{ $row->id }}" {{ $row->id==$data->brand_id? 'selected' : '' }}>{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="">Category</label>
                                        <select class="form-control show-tick" name="cat_id">
                                            <option selected disabled value="">-- Choose --</option>
                                            @foreach (App\Models\Category::get() as $row)
                                                <option value="{{ $row->id }}" {{ $row->id==$data->cat_id? 'selected' : '' }}>{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="">Size</label>
                                        <select class="form-control show-tick" name="size">
                                            <option selected disabled value="">-- Choose --</option>
                                            <option value="S" {{$data->size=='S' ? 'selected' : ''}}>Small</option>
                                            <option value="M" {{$data->size=='M' ? 'selected' : ''}}>Medium</option>
                                            <option value="L" {{$data->size=='L' ? 'selected' : ''}}>Large</option>
                                            <option value="XL" {{$data->size=='XL' ? 'selected' : ''}}>Extra Large</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="">Condition</label>
                                        <select class="form-control show-tick" name="conditions">
                                            <option selected disabled value="">-- Choose --</option>
                                            <option value="new" {{$data->conditions=='new' ? 'selected' : ''}}>New</option>
                                            <option value="popular" {{$data->conditions=='popular' ? 'selected' : ''}}>Popular</option>
                                            <option value="winter" {{$data->conditions=='winter' ? 'selected' : ''}}>Winter</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="">Status</label>
                                        <select class="form-control show-tick" name="status">
                                            <option selected disabled value="">-- Choose --</option>
                                            <option value="active" {{$data->status=='active' ? 'selected' : ''}}>Active</option>
                                            <option value="inactive" {{$data->status=='inactive' ? 'selected' : ''}}>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Image Upload <span class="text-danger">*</span></label><br>
                                            <span class="text-danger">*Old Photo : </span><img src="{{ asset($data->photo) }}" style="height: 100px; width:75px;">
                                            <input type="file" name="photo"  accept="image/*" class="dropify">
                                            <input type="hidden" name="old_photo" value="{{ $data->photo }}" >
                                        </div><br>
                                    </div>

                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
	<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
	<script>
		 $('#lfm').filemanager('image');
	</script>
	<script>
	    $(document).ready(function() {
	        $('#description').summernote();
	    });
	 </script>

    {{-- Dropify --}}
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

    <script type="text/javascript">
        $('.dropify').dropify();
    </script>
@endsection
