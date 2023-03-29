<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $prdct_dtls=Product::where('slug',$slug)->first();
        if ($prdct_dtls) {
            return view('frontend.pages.product.product-details',compact('prdct_dtls'));
        }
        else{
            return 'Product Details Not Found!';
        }
    }
}
