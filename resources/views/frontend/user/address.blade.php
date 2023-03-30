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
                        <p>The following addresses will be used on the checkout page by default.</p>

                        <div class="row">
                            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                                <h6 class="mb-3">Billing Address</h6>
                                <address>
                                    {{ $usr->b_address }} <br>
                                    {{ $usr->b_city }} <br>
                                    {{ $usr->b_state }} <br>
                                    {{ $usr->b_postcode }} <br>
                                    {{ $usr->b_country }}
                                </address>

                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#editAddress">Edit Billing Address</a>
                                <!-- Modal -->
                                <div class="modal fade" id="editAddress" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Billing Address</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('user.billingaddress.store',$usr->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Billing Address</label>
                                                        <textarea name="b_address" class="form-control" id="">{{ $usr->b_address }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Billing City</label>
                                                        <input name="b_city" value="{{ $usr->b_city }}" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Billing Postcode</label>
                                                        <input name="b_postcode" value="{{ $usr->b_postcode }}" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Billing District</label>
                                                        <input name="b_state" value="{{ $usr->b_state }}" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Billing Country</label>
                                                        <input name="b_country" value="{{ $usr->b_country }}" class="form-control" id="">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h6 class="mb-3">Shipping Address</h6>
                                <address>
                                    {{ $usr->s_address }} <br>
                                    {{ $usr->s_city }} <br>
                                    {{ $usr->s_state }} <br>
                                    {{ $usr->s_postcode }} <br>
                                    {{ $usr->s_country }}
                                </address>
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#editShippingAddress">Edit Shipping Address</a>
                                <!-- Modal -->
                                <div class="modal fade" id="editShippingAddress" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Shipping Address</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('user.shippingaddress.store',$usr->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Shipping Address</label>
                                                        <textarea name="s_address" class="form-control" id="">{{ $usr->s_address }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping City</label>
                                                        <input name="s_city" value="{{ $usr->s_city }}" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping Postcode</label>
                                                        <input name="s_postcode" value="{{ $usr->s_postcode }}" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping District</label>
                                                        <input name="s_state" value="{{ $usr->s_state }}" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping Country</label>
                                                        <input name="s_country" value="{{ $usr->s_country }}" class="form-control" id="">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->
    <style>
        .footer_area{
            z-index: -1;
        }
    </style>
@endsection

@section('styles')
    <style>
        .footer_area{
            z-index: -1;
        }
    </style>
@endsection
