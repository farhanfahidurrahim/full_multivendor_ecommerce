@extends('frontend.layouts.master')
@section('content')

<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>Checkout</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Checkout Step Area -->
<div class="checkout_steps_area">
    <a class="active" href="checkout-2.html"><i class="icofont-check-circled"></i> Billing</a>
    <a href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
    <a href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
    <a href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
</div>

<!-- Checkout Area -->
<div class="checkout_area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="checkout_details_area clearfix">
                    <h5 class="mb-4">Billing Details</h5>
                    <form action="{{ route('checkout1.store') }}" method="post">
                        @csrf
                        <div class="row">
                            @php
                                $name=explode(' ',$userInfo->full_name);
                            @endphp
                            <div class="col-md-6 mb-3">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="{{ $name[0] }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="{{ $name[1] }}" required>
                            </div>
                            {{-- <div class="col-md-6 mb-3">
                                <label for="company">Company Name</label>
                                <input type="text" class="form-control" id="company" placeholder="Company Name" value="">
                            </div> --}}
                            <div class="col-md-6 mb-3">
                                <label for="email_address">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ $userInfo->email }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone_number">Phone Number</label>
                                <input type="number" class="form-control" name="phone" id="phone" min="0" value="{{ $userInfo->phone }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="street_address">Full Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Street Address" value="{{ $userInfo->address }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="street_address">Upazila/City</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="Street City" value="{{ $userInfo->city }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state">District/State</label>
                                <input type="text" class="form-control" name="state" id="state" placeholder="State" value="{{ $userInfo->state }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="postcode">Postcode/Zip</label>
                                <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode / Zip" value="{{ $userInfo->postcode }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" name="country" id="country" min="0" value="{{ $userInfo->country }}">
                            </div>
                            <div class="col-md-12">
                                <label for="order-notes">Order Notes</label>
                                <textarea class="form-control" name="note" id="order-notes" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>

                        <!-- Same Shipping Address -->
                        <div class="different-address mt-50">
                            <div class="ship-different-title mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Ship to a same address??</label>
                                </div>
                            </div>
                            <div class="row shipping_input_field">
                                @php
                                    $name=explode(' ',$userInfo->full_name);
                                @endphp
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" name="shipping_first_name" id="shipping_first_name" placeholder="First Name" value="{{ $name[0] }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" name="shipping_last_name" id="shipping_last_name" placeholder="Last Name" value="{{ $name[1] }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_address">Email Address</label>
                                    <input type="email" class="form-control" name="shipping_email" id="shipping_email" placeholder="Email Address" value="{{ $userInfo->email }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="number" class="form-control" name="shipping_phone" id="shipping_phone" min="0" placeholder="Phone Number" value="{{ $userInfo->phone }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="street_address">Full Address</label>
                                    <input type="text" class="form-control" name="shipping_address" id="shipping_address" placeholder="Full Address" value="{{ $userInfo->shipping_address }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="street_address">Upazila/City</label>
                                    <input type="text" class="form-control" name="shipping_city" id="shipping_city" placeholder="Upazila / City" value="{{ $userInfo->shipping_city }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="state">District/State</label>
                                    <input type="text" class="form-control" name="shipping_state" id="shipping_state" placeholder="District / State" value="{{ $userInfo->shipping_state }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="postcode">Postcode/Zip</label>
                                    <input type="text" class="form-control" name="shipping_postcode" id="shipping_postcode" placeholder="Postcode / Zip" value="{{ $userInfo->shipping_postcode }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" name="shipping_country" id="shipping_country" placeholder="Country" value="{{ $userInfo->shipping_country }}">
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="sub_total" value="{{ Cart::instance('shopping')->subtotal() }}">
                                    <input type="hidden" name="total_amount" value="{{ Cart::instance('shopping')->subtotal() }}">
                                    <div class="checkout_pagination d-flex justify-content-end mt-50">
                                        <a href="{{ route('cart.index') }}" class="btn btn-primary mt-2 ml-2">Go Back</a>
                                        <button type="submit" class="btn btn-primary mt-2 ml-2">Continue</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Checkout Area -->

@endsection

@section('scripts')
    <script>
        $('#customCheck1').on('change',function(e){
            e.preventDefault();
            if (this.checked) {
                $('#shipping_first_name').val($('#first_name').val());
                $('#shipping_last_name').val($('#last_name').val());
                $('#shipping_email').val($('#email').val());
                $('#shipping_phone').val($('#phone').val());
                $('#shipping_address').val($('#address').val());
                $('#shipping_city').val($('#city').val());
                $('#shipping_state').val($('#state').val());
                $('#shipping_postcode').val($('#postcode').val());
                $('#shipping_country').val($('#country').val());
            }
            else{
                $('#shipping_first_name').val("");
                $('#shipping_last_name').val("");
                $('#shipping_email').val("");
                $('#shipping_phone').val("");
                $('#shipping_address').val("");
                $('#shipping_city').val("");
                $('#shipping_state').val("");
                $('#shipping_postcode').val("");
                $('#shipping_country').val("");
            }
        })
    </script>
@endsection
