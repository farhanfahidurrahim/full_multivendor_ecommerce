<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Auth;
use Session;
use Hash;

class IndexController extends Controller
{
    // User Auth : Login Register Logout
    public function userLoginRegister()
    {
        return view('frontend.auth-user.login-register');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:6'
        ]);
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password,'status'=>'active'])) {
            Session::put('user',$request->email);

            if (Session::get('url.intended')) {
                return Redirect::to(Session::get('url.intended'));
            }
            else{
                return redirect()->route('home')->with('success','Successfully Login!');
            }
        }
        else{
            return back()->with('error','Invalid Email or Password!');
        }
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'full_name'=>'required|string',
            'username'=>'required|string',
            'email'=>'email|required|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);

        $data=$request->all();
        $data['password']=Hash::make($request->password);
        $store=User::create($data);
        Session::put('user',$data['email']);
        Auth::login($store);
        if ($store) {
            return redirect()->route('home')->with('success','Registration Successfully!');
        }
        else{
            return back()->with('error','Please Try Again!');
        }
    }

    public function logoutSubmit()
    {
        Session::forget('user');
        Auth::logout();
        return redirect()->route('user.auth')->with('success','Successfully Logout!');
    }

    // Frontend Part : Home Page Category Products Brand etc
    public function index()
    {
        $banner=Banner::where(['status'=>'active','condition'=>'banner'])->orderBy('id','DESC')->limit('3')->get();
        $categories=Category::where(['status'=>'active','is_parent'=>1])->orderBy('id','DESC')->limit('3')->get();
        return view('frontend.index',compact('banner','categories'));
    }

    public function productCategory($slug)
    {
        $pdcat=Category::with('productsMR')->where('slug',$slug)->first();
        return view('frontend.pages.product-category',compact('pdcat'));
    }

    public function productDetails($slug)
    {
        //dd($slug);
        $prdct_dtls=Product::with('relatedProductMR')->where('slug',$slug)->first();
        if ($prdct_dtls) {
            return view('frontend.pages.product.product-details',compact('prdct_dtls'));
        }
        else{
            return 'Product Details Not Found!';
        }
    }

    // User Account : Profile Edit Update Order
    public function userDashboard()
    {
        $usr=Auth::user();
        return view('frontend.user.dashboard',compact('usr'));
    }

    public function userOrder()
    {
        return view('frontend.user.order');
    }

    public function userAddress()
    {
        $usr=Auth::user();
        return view('frontend.user.address',compact('usr'));
    }

    public function userAccountDetails()
    {
        $usr=Auth::user();
        return view('frontend.user.account-details',compact('usr'));
    }
}
