@extends('backend.layouts.master')
@section('content')

<div id="main-content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>View Order</strong></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->payment_method=="cod" ? "Cash On Delivery" : $order->payment_method }}</td>
                                        <td>{{ ucfirst($order->payment_status) }}</td>
                                        <td>{{ number_format($order->total_amount,2) }}</td>
                                        <td><span class="badge
                                            @if($order->condition=='pending')
                                                badge-info
                                            @elseif($order->condition=='processing')
                                                badge-primary
                                            @elseif($order->condition=='delivered')
                                                badge-success
                                            @else
                                                badge-danger
                                            @endif
                                                ">{{ $order->condition }}</span></td>
                                        <td class="">
                                            <a href="" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-outline-warning"><i class="fas fa-download"></i></a>

                                            <form class="px-3" onclick="return confirm('Are you sure you want to delete?')" method="POST" action="#">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product Image</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $item)
                                        <tr>
                                            <td></td>
                                            <td><img src="{{ asset($item->photo) }}" style="max-width: 65px" alt="img"></td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->pivot->quantity }}</td>
                                            <td>{{ number_format($item->price,2) }}</td>
                                            <td><span class="badge
                                                @if($item->condition=='pending')
                                                    badge-info
                                                @elseif($item->condition=='processing')
                                                    badge-primary
                                                @elseif($item->condition=='delivered')
                                                    badge-success
                                                @else
                                                    badge-danger
                                                @endif
                                                    ">{{ $item->condition }}</span></td>
                                            <td class="">
                                                <a href="{{ route('order.show',$item->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-outline-warning"><i class="fas fa-download"></i></a>

                                                <form class="px-3" onclick="return confirm('Are you sure you want to delete?')" method="POST" action="#">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">

                        </div>
                        <div class="col-4 border py-3">
                            <p><strong>Subtotal:</strong> <span class="text-danger"> ${{ $order->sub_total }} </span></p>
                            <p><strong>Delivery:</strong> <span class="text-danger">${{ $order->delivery_charge }}</span></p>
                            <p><strong>Coupon:</strong> <span class="text-danger">${{ $order->coupon }}</span></p>
                            <p><strong>Total:</strong> <span class="text-danger">${{ $order->total_amount }}</span></p>

                            <form accept="{{ route('order.status',$order->id) }}" method="post">
                            @csrf
                                <label>Status</label>
                                <select name="condition" id="" class="form-control">
                                    <option value="pending" {{ $order->condition=='pending'?'selected':'' }}>Pending</option>
                                    <option value="processing" {{ $order->condition=='processing'?'selected':'' }}>Processing</option>
                                    <option value="delivered" {{ $order->condition=='delivered'?'selected':'' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->condition=='cancelled'?'selected':'' }}>Cancel</option>
                                </select>
                                <button class="btn btn-sm btn-success">Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
