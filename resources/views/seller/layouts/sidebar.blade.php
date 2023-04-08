<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{ asset('backend/assets/images/user.png') }}" class="rounded-circle user-photo" alt="User Profile Picture">
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="user-name" data-toggle="dropdown"><strong>{{ auth('seller')->user()->full_name }}</strong>
                    <span>
                        @if(auth('seller')->user()->is_verified) <i class="fas fa-check-circle text-success" data-toggle="tooltip" title="verified"></i>
                        @else
                        <i class="fas fa-user-times text-danger" data-toggle="tooltip" title="unverified"></i>
                        @endif
                    </span>
                </a>
            </div>
            <hr>
        </div>
        <!-- Tab panes -->
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane active" id="admin">
                <nav class="sidebar-nav">
                    <ul class="main-menu metismenu">
                        <li class="active"><a href="{{ route('seller') }}"><i class="icon-home"></i><span>Dashboard</span></a></li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-control-pause"></i><span>Product Management</span> </a>
                            <ul>
                                <li><a href="{{ route('seller-product.index') }}">All Products</a></li>
                                <li><a href="{{ route('seller-product.create') }}">Add Products</a></li>
                            </ul>

                        <li><a href="{{ route('order.index') }}"><i class="icon-support"></i>Order Management</a></li>
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
