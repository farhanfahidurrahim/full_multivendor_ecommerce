<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Brand::orderBy('id','DESC')->get();
        return view('backend.brand.index',compact('data'));
    }

    public function brandStatus(Request $request)
    {
        //dd($request->all());
        if ($request->mode=='true') {
            DB::table('brands')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('brands')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'nullable|string',
            'photo'=>'required',
            'status'=>'nullable|in:active,inactive',
        ]);
        $data=$request->all();
        $slug=Str::slug($request->input('title'));
        $data['slug']=$slug;
        $store=Brand::create($data);
        if ($store) {
            toastr()->success('Brand Created Successfully');
            return redirect()->route('brand.index');
        }
        else{
            toastr()->error('An error has occurred please try again!');
            return redirect()->route('brand.index');
        }
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
        $data=Brand::find($id);
        $data->delete();
        if ($data) {
            toastr()->success('Brand Deleted successfully!');
            return redirect()->route('brand.index');
        }

        toastr()->error('An error has occurred please try again!');
        return back();
    }
}
