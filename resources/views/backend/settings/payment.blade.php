@extends('backend.layouts.master')
@section('content')

	<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Payment Methods</h2>
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
                        	<form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row clearfix">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                    	<label for="">Client ID</label>
                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="CLIENT_ID">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                	<label for="">Image Upload</label>
                                    <div class="input-group">
										<span class="input-group-btn">
											<a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose </a>
										</span>
										<input id="thumbnail" class="form-control" type="text" name="photo">
									</div>
									<div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                	<label for="">Description</label>
                                    <div class="form-group">
                                        <textarea id="description" class="form-control" name="description" placeholder="Write some text">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                            	<div class="col-lg-4 col-md-6 col-sm-12">
                                	<label for="">Condition</label>
                                    <select class="form-control show-tick" name="condition">
                                        <option selected disabled value="">-- Choose --</option>
                                        <option value="banner" {{old('condition')=='banner' ? 'selected' : ''}}>Banner</option>
                                        <option value="promo" {{old('condition')=='promo' ? 'selected' : ''}}>Promotional</option>
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

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
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

