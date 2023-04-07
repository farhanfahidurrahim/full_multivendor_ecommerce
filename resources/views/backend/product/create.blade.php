@extends('backend.layouts.master')
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
                        	<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row clearfix">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                    	<label for="">Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                	<label for="">Summary</label>
                                    <div class="form-group">
                                        <textarea id="summary" class="form-control" name="summary" placeholder="Write some text">{{ old('summary') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                	<label for="">Description</label>
                                    <div class="form-group">
                                        <textarea id="description" class="form-control" name="description" placeholder="Write some text">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-12 col-md-12">
                                	<label for="">Image Upload <span class="text-danger">[Recommended Width*Length '300*450']</span></label>
                                    <div class="input-group">
										<span class="input-group-btn">
											<a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose </a>
										</span>
										<input id="thumbnail" class="form-control" type="text" name="photo">
									</div>
									<div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                </div> --}}

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                    	<label for="">Stock</label>
                                        <input type="number" class="form-control" name="stock" value="{{ old('stock') }}" placeholder="Stock">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                    	<label for="">Price</label>
                                        <input type="number" class="form-control" name="price" value="{{ old('price') }}" placeholder="Price">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                    	<label for="">Discount (%)</label>
                                        <input type="number" min="0" max="99" class="form-control" name="discount" value="{{ old('discount') }}" placeholder="Discount">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                	<label for="">Brand</label>
                                    <select class="form-control show-tick" name="brand_id">
                                        <option selected disabled value="">-- Choose --</option>
                                        @foreach ($brands as $row)
                                            <option value="{{ $row->id }}">{{ $row->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            	<div class="col-lg-4 col-md-6 col-sm-12">
                                	<label for="">Category</label>
                                    <select class="form-control show-tick" name="cat_id">
                                        <option selected disabled value="">-- Choose --</option>
                                        @foreach ($categories as $row)
                                            <option value="{{ $row->id }}">{{ $row->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                	<label for="">Vendor</label>
                                    <select class="form-control show-tick" name="vendor_id">
                                        <option selected disabled value="">-- Choose --</option>
                                        @foreach ($vendors as $row)
                                            <option value="{{ $row->id }}">{{ $row->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                	<label for="">Size</label>
                                    <select class="form-control show-tick" name="size">
                                        <option selected disabled value="">-- Choose --</option>
                                        <option value="S" {{old('size')=='S' ? 'selected' : ''}}>Small</option>
                                        <option value="M" {{old('size')=='M' ? 'selected' : ''}}>Medium</option>
                                        <option value="L" {{old('size')=='L' ? 'selected' : ''}}>Large</option>
                                        <option value="XL" {{old('size')=='XL' ? 'selected' : ''}}>Extra Large</option>
                                    </select>
                                </div>

                            	<div class="col-lg-4 col-md-6 col-sm-12">
                                	<label for="">Condition</label>
                                    <select class="form-control show-tick" name="conditions">
                                        <option selected disabled value="">-- Choose --</option>
                                        <option value="new" {{old('conditions')=='new' ? 'selected' : ''}}>New</option>
                                        <option value="popular" {{old('conditions')=='popular' ? 'selected' : ''}}>Popular</option>
                                        <option value="winter" {{old('conditions')=='winter' ? 'selected' : ''}}>Winter</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                	<label for="">Status</label>
                                    <select class="form-control show-tick" name="status">
                                        <option selected disabled value="">-- Choose --</option>
                                        <option value="active" {{old('status')=='active' ? 'selected' : ''}}>Active</option>
                                        <option value="inactive" {{old('status')=='inactive' ? 'selected' : ''}}>Inactive</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Image Upload <span class="text-danger">*[Recommended Width*Length '300*450']</span></label><br>
                                        <input type="file" name="photo" required="" accept="image/*" class="dropify">
                                    </div><br>
                                </div>

                                {{-- <div class="">
                                    <table class="table table-bordered" id="dynamic_field">
                                        <div class="card-header">
                                            <h3 class="card-title">More Images (Click Add For More Image)</h3>
                                        </div>
                                        <tr>
                                        <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>
                                        </tr>
                                    </table>
                                </div> --}}

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
