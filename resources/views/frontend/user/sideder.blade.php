<ul>
    <li class="{{ Request::is('user/dashboard') ? 'active' : '' }}"><a href="{{ route('user.myaccount') }}">Dashboard</a></li>
    <li class="{{ Request::is('user/order') ? 'active' : '' }}"><a href="{{ route('user.order') }}">Orders</a></li>
    <li class="{{ Request::is('user/addresses') ? 'active' : '' }}"><a href="{{ route('user.address') }}">Addresses</a></li>
    <li class="{{ Request::is('user/account-details') ? 'active' : '' }}"><a href="{{ route('user.account.details') }}">Account Details</a></li>
    <li><a href="{{ route('user.logout') }}">Logout</a></li>
</ul>
