<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Coupon::orderBy('id','DESC')->get();
        return view('backend.coupon.index',compact('data'));
    }

    public function couponStatus(Request $request)
    {
        if ($request->mode=='true') {
            DB::table('coupons')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('coupons')->where('id',$request->id)->update(['status'=>'inactive']);
        }

        return response()->json(['msg'=>'Successfully Updated Status','status'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required|min:4',
            'value'=>'required|numeric',
            'type'=>'required',
            'status'=>'required',
        ]);
        $data=$request->all();
        $store=Coupon::create($data);
        if ($store) {
            return redirect()->route('coupon.index')->with('success',"Coupon Created Successfully!");
        }
        return redirect()->back()->with('error',"Error!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
