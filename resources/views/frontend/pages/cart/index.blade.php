@extends('frontend.layouts.master')
@section('content')

<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>Cart</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Cart Area -->
<div class="cart_area section_padding_100_70 clearfix">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12">
                <div class="cart-table">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-30">
                            <thead>
                                <tr>
                                    <th scope="col"><i class="icofont-ui-delete"></i></th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::instance('shopping')->content() as $item )
                                <tr>
                                    <th scope="row">
                                        <i class="icofont-close cart_delete" data-id="{{ $item->rowId }}"></i>
                                    </th>
                                    <td>
                                        <img src="{{ $item->photo }}" alt="Cart Img">
                                    </td>
                                    <td>
                                        <a href="#">{{ $item->name }}</a>
                                    </td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        <div class="quantity">
                                            <input type="number" data-id="{{ $item->rowId }}" class="qty-text" id="qty-input-{{ $item->rowId }}" step="1" min="1" max="99" name="quantity" value="{{ $item->qty }}">
                                        </div>
                                    </td>
                                    <td>{{ $item->subtotal() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="cart-apply-coupon mb-30">
                    <h6>Have a Coupon?</h6>
                    <p>Enter your coupon code here &amp; get awesome discounts!</p>
                    <!-- Form -->
                    <div class="coupon-form">
                        <form action="{{ route('coupon.add') }}" method="POST" id="coupon-form">
                            @csrf
                            <input type="text" name="code" class="form-control" placeholder="Enter Your Coupon Code">
                            <button type="submit" class="coupon-btn btn btn-primary">Apply Coupon</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="cart-total-area mb-30">
                    <h5 class="mb-3">Cart Totals</h5>
                    <div class="table-responsive">
                        <table class="table mb-3">
                            <tbody>
                                <tr>
                                    <td>Sub Total</td>
                                    <td>${{ Cart::subtotal() }}</td>
                                </tr>
                                <tr>
                                    <td>Save Amount</td>
                                    <td>$@if(Session::get('coupon')){{ number_format(Session::get('coupon')['value']) }} @else 0 @endif</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    @if (Session::has('coupon'))
                                    <td>${{ Cart::subtotal()-Session::get('coupon')['value'] }}</td>
                                    @else
                                    ${{ Cart::subtotal() }}
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('checkout1') }}" class="btn btn-primary d-block">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Area End -->

@endsection

@section('scripts')
    <!-- Cart Destroy by Ajax -->
    <script>
        $(document).on('click','.cart_delete',function(e){
            e.preventDefault();
            var cart_id=$(this).data('id');

            var token="{{ csrf_token() }}";
            var path="{{ route('cart.destroy') }}";

            $.ajax({
                url:path,
                type:"POST",
                dataType:"JSON",
                data:{
                    cart_id: cart_id,
                    _token:token,
                },
                success:function(data){
                    console.log(data);

                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart_counter').html(data['cart_count']);
                        Swal.fire({
                            title: 'Success!',
                            text: data['message'],
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                },
                error:function (err){
                    console.log(err);
                }
            });
        });
    </script>

    <!-- Cart Product Quantity Update by Ajax -->
    <script>
        $(document).on('click','.qty-text',function(){
            var id=$(this).data('id');

            var spinner=$(this),input=spinner.closest("div.quantity").find('input[type="number"]');
            alert(input.val());
        });
    </script>

    <!-- Apply Coupon on Cart Page by Ajax -->
    <script>
        $(document).on('click','.coupon-btn',function(e){
            e.preventDefault();
            var code=$('input[name=code]').val();
            $('.coupon-btn').html('<i class="fa fa-spinner fa-spin"></i> Applying...');
            $('#coupon-form').submit();
        });
    </script>
@endsection
