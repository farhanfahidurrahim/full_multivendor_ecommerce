<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{ asset('backend/assets/images/user.png') }}" class="rounded-circle user-photo" alt="User Profile Picture">
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ auth('admin')->user()->full_name }}</strong></a>
            </div>
            <hr>
        </div>
        <!-- Tab panes -->
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane active" id="admin">
                <nav class="sidebar-nav">
                    <ul class="main-menu metismenu">
                        <li class="active"><a href="{{ route('admin') }}"><i class="icon-home"></i><span>Dashboard</span></a></li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-control-pause"></i><span>Banner Management</span> </a>
                            <ul>
                                <li><a href="{{ route('banner.index') }}">All Banners</a></li>
                                <li><a href="{{ route('banner.create') }}">Add Banner</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-notebook"></i><span>Brand Management</span> </a>
                            <ul>
                                <li><a href="{{ route('brand.index') }}">All Brand</a></li>
                                <li><a href="{{ route('brand.create') }}">Add Brand</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-graduation"></i><span>Category Management</span> </a>
                            <ul>
                                <li><a href="{{ route('category.index') }}">All Category</a></li>
                                <li><a href="{{ route('category.create') }}">Add Category</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-share fa-rotate-90 d-inline-block"></i><span>Product Management</span> </a>
                            <ul>
                                <li><a href="{{ route('product.index') }}">All Product</a></li>
                                <li><a href="{{ route('product.create') }}">Add Product</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-wallet"></i><span>User Managemnet</span> </a>
                            <ul>
                                <li><a href="{{ route('user.index') }}">All User</a></li>
                                <li><a href="{{ route('user.create') }}">Add User</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-info"></i><span>Coupon Managemnet</span> </a>
                            <ul>
                                <li><a href="{{ route('coupon.index') }}">All Coupon</a></li>
                                <li><a href="{{ route('coupon.create') }}">Add Coupon</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-list"></i><span>Shipping Managemnet</span> </a>
                            <ul>
                                <li><a href="{{ route('shipping.index') }}">All Shipping</a></li>
                                <li><a href="{{ route('shipping.create') }}">Add Shipping</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('order.index') }}"><i class="icon-support"></i>Order Management</a></li>
                        <li><a href="app-taskboard.html"><i class="icon-pin"></i>Seller Management</a></li>
                        <li><a href="hostel.html"><i class="icon-target"></i>Hostel</a></li>
                        <li><a href="transport.html"><i class="icon-support"></i>Transport</a></li>
                        <li><span>-- Extra</span></li>
                        <li>
                            <a href="#Authentication" class="has-arrow"><i class="icon-lock"></i><span>Authentication</span></a>
                            <ul>
                                <li><a href="page-login.html">Login</a></li>
                                <li><a href="page-register.html">Register</a></li>
                                <li><a href="page-lockscreen.html">Lockscreen</a></li>
                                <li><a href="page-forgot-password.html">Forgot Password</a></li>
                                <li><a href="page-404.html">Page 404</a></li>
                                <li><a href="page-403.html">Page 403</a></li>
                                <li><a href="page-500.html">Page 500</a></li>
                                <li><a href="page-503.html">Page 503</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
