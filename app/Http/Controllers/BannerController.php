<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
use DB;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data=Banner::orderBy('id','DESC')->get();
        return view('backend.banners.index',compact('data'));
    }

    public function bannerStatus(Request $request)
    {
        //dd($request->all());
        if ($request->mode=='true') {
            DB::table('banners')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('banners')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //dd($request->all());
        $request->validate([
            'title'=>'string|required',
            'photo'=>'required',
            'description'=>'required',
            'condition'=>'required',
            'status'=>'required',
        ]);

        $data=$request->all();
        $slug=Str::slug($request->input('title'));
        $data['slug']=$slug;
        $store=Banner::create($data);
        if ($store) {
            toastr()->success('Banner Created successfully!');
            return redirect()->route('banner.index');
        }

        toastr()->error('An error has occurred please try again!');
        return back();
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
        $data=Banner::find($id);
        return view('backend.banners.edit',compact('data'));
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
        $finddata=Banner::find($id);
        if ($finddata) {
            $request->validate([
            'title'=>'string|required',
            'photo'=>'required',
            'description'=>'required',
            'condition'=>'required',
        ]);

            $data=$request->all();
            $slug=Str::slug($request->input('title'));
            $data['slug']=$slug;
            $update=$finddata->fill($data)->save();
            if ($update) {
                toastr()->success('Banner Updated successfully!');
                return redirect()->route('banner.index');
            }

            toastr()->error('An error has occurred please try again!');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Banner::find($id);
        $data->delete();
        if ($data) {
            toastr()->success('Banner Deleted successfully!');
            return redirect()->route('banner.index');
        }
            toastr()->error('An error has occurred please try again!');
            return back();
    }
}
