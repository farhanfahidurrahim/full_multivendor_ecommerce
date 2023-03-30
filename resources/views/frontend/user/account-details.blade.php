@extends('frontend.layouts.master')
@section('content')

<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>My Account</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">My Account</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- My Account Area -->
<section class="my-account-area section_padding_100_50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="my-account-navigation mb-50">
                    @include('frontend.user.sideder')
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="my-account-content mb-50">
                    <h5 class="mb-3">Account Details</h5>

                    <form action="{{ route('user.account.update',$usr->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="firstName">Full Name *</label>
                                    <input type="text" class="form-control" name="full_name" value="{{ $usr->full_name }}" id="firstName" placeholder="Full Name">
                                    @error('full_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="lastName">Username *</label>
                                    <input type="text" class="form-control" name="username" value="{{ $usr->username }}" id="lastName" placeholder="Username">
                                    @error('username')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="emailAddress">Phone Number *</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ $usr->phone }}" id="emailAddress" placeholder="+880..........">
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="emailAddress">Email Address *</label>
                                    <input type="email" class="form-control" name="email" value="{{ $usr->email }}" id="emailAddress" placeholder="care.designingworld@gmail.com" disabled>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="currentPass">Current Password (Leave blank to leave unchanged)</label>
                                    <input type="password" name="old_password" class="form-control" id="currentPass">
                                    @error('old_password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="newPass">New Password (Leave blank to leave unchanged)</label>
                                    <input type="password" name="new_password" class="form-control" id="newPass">
                                    @error('new_password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <label for="confirmPass">Confirm New Password</label>
                                    <input type="password" name="confirm_password" class="form-control" id="confirmPass">
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- My Account Area -->

@endsection
