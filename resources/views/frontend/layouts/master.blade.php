<!doctype html>
<html lang="en">

<head>

    @include('frontend.layouts.head')

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <!-- Header Area -->
    <header class="header_area" id="header-ajax">
        @include('frontend.layouts.header')
    </header>
    <!-- Header Area End -->

    @yield('content')

    <!-- Footer Area -->
    @include('frontend.layouts.footer')
    <!-- Footer Area -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    @include('frontend.layouts.script')

    <!-- Custom Ajax Header Product Delete Item on Cart -->
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

</body>

</html>
