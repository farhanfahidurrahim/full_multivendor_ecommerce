<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout1()
    {
        $userInfo=Auth::user();
        return view('frontend.pages.checkout.checkout1',compact('userInfo'));
    }

    public function checkout1Store(Request $request)
    {
        $request->validate([
            'first_name'=>'string|required',
            'last_name'=>'string|required',
            'email'=>'email|required|exists:users,email',
            'address'=>'string|required',
            'city'=>'string|required',
            'state'=>'string|required',
            'postcode'=>'numeric|required',
            'country'=>'string|required',
            'shipping_address'=>'string|required',
            'shipping_city'=>'string|required',
            'shipping_state'=>'string|required',
            'shipping_postcode'=>'numeric|required',
            'shipping_country'=>'string|required',
        ]);
        Session::put('checkout',[
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'city'=>$request->city,
            'state'=>$request->state,
            'postcode'=>$request->postcode,
            'country'=>$request->country,
            'note'=>$request->note,
            'shipping_first_name'=>$request->shipping_first_name,
            'shipping_last_name'=>$request->shipping_last_name,
            'shipping_email'=>$request->shipping_email,
            'shipping_phone'=>$request->shipping_phone,
            'shipping_address'=>$request->shipping_address,
            'shipping_city'=>$request->shipping_city,
            'shipping_state'=>$request->shipping_state,
            'shipping_postcode'=>$request->shipping_postcode,
            'shipping_country'=>$request->shipping_country,
            'sub_total'=>$request->sub_total,
            'total_amount'=>$request->total_amount,
        ]);

        $shippings=Shipping::where('status','active')->orderBy('id','ASC')->get();
        return view('frontend.pages.checkout.checkout2',compact('shippings'));
    }

    public function checkout2Store(Request $request)
    {
        $request->validate([
            'delivery_charge'=>'required|numeric',
        ]);
        Session::push('checkout',[
            'delivery_charge'=>$request->delivery_charge,
        ]);
        return view('frontend.pages.checkout.checkout3');
    }

    public function checkout3Store(Request $request)
    {
        //return $request->all();
        // $request->validate([
        //     'payment_method'=>'required|string',
        // ]);
        Session::push('checkout',[
            'payment_method'=>$request->payment_method,
            'payment_status'=>'unpaid',
        ]);
        $p=Product::all();
        return view('frontend.pages.checkout.checkout4',compact('p'));
    }

    public function checkoutStore()
    {
        $order=new Order();
        $order['user_id']=auth()->user()->id;
        $order['order_number']=Str::upper('ORD-'.Str::random(6));
        //return Session::get('checkout');
        $order['sub_total']=Session::get('checkout')['sub_total'];
        $order['delivery_charge']=Session::get('checkout')[0]['delivery_charge'];
        if (Session::has('coupon')) {
            $order['coupon']=Session::get('coupon')['value'];
        }else {
            $order['coupon']=number_format(('0'),2);
        }
        $order['total_amount']=number_format((float) str_replace(',','',Session::get('checkout')['sub_total'])+Session::get('checkout')[0]['delivery_charge'],2);
        $order['payment_method']=Session::get('checkout')[1]['payment_method'];
        $order['payment_status']=Session::get('checkout')[1]['payment_status'];
        $order['condition']='pending';
        $order['delivery_charge']=Session::get('checkout')[0]['delivery_charge'];
        $order['first_name']=Session::get('checkout')['first_name'];
        $order['last_name']=Session::get('checkout')['last_name'];
        $order['email']=Session::get('checkout')['email'];
        $order['phone']=Session::get('checkout')['phone'];
        $order['address']=Session::get('checkout')['address'];
        $order['city']=Session::get('checkout')['city'];
        $order['state']=Session::get('checkout')['state'];
        $order['postcode']=Session::get('checkout')['postcode'];
        $order['country']=Session::get('checkout')['country'];
        $order['note']=Session::get('checkout')['note'];
        $order['shipping_first_name']=Session::get('checkout')['first_name'];
        $order['shipping_last_name']=Session::get('checkout')['last_name'];
        $order['shipping_email']=Session::get('checkout')['shipping_email'];
        $order['shipping_phone']=Session::get('checkout')['shipping_phone'];
        $order['shipping_address']=Session::get('checkout')['shipping_address'];
        $order['shipping_city']=Session::get('checkout')['shipping_city'];
        $order['shipping_state']=Session::get('checkout')['shipping_state'];
        $order['shipping_postcode']=Session::get('checkout')['shipping_postcode'];
        $order['shipping_country']=Session::get('checkout')['shipping_country'];

        $store=$order->save();
        if ($store) {
            Mail::to($order['email'])->bcc($order['shipping_email'])->cc('ffr@gmail.com')->send(new OrderMail($order));
            //dd('Mail is send');
            Cart::instance('shopping')->destroy();
            Session::forget('coupon');
            Session::forget('checkout');
            return redirect()->route('checkout.complete',$order['order_number']);
        }
        else{
            return redirect()->route('checkout1')->with('error',"Please Try Again!");
        }
        return $order;
    }

    public function checkoutComplete($order)
    {
        $order=$order;
        return view('frontend.pages.checkout.complete',compact('order'));
    }
}
