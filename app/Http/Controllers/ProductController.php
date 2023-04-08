<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Product::orderBy('id','DESC')->get();
        return view('backend.product.index',compact('data'));
    }

    public function productStatus(Request $request)
    {
        //dd($request->all());
        if ($request->mode=='true') {
            DB::table('products')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('products')->where('id',$request->id)->update(['status'=>'inactive']);
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
        $brands=Brand::where('status','active')->get();
        $categories=Category::where('status','active')->get();
        return view('backend.product.create',compact('brands','categories'));
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
            'title'=>'required',
            'summary'=>'required',
            'description'=>'required',
            'photo'=>'required',
            'stock'=>'required',
            'price'=>'required|numeric',
            'discount'=>'required|numeric',
            'size'=>'required',
            'conditions'=>'required',
            'status'=>'required',
            'brand_id'=>'required',
            'cat_id'=>'required',
        ]);

        $slug=Str::slug($request->title, '-');
        if ($request->hasFile('photo')) {

            $file=$request->file('photo');
            $filename=$slug.'.'.$file->getClientOriginalExtension();
            //$file->move(public_path('file/img/product/'),$filename);
            Image::make($file)->resize(300,450)->save('file/img/product/'.$filename);
            $path="file/img/product/$filename";
            //dd($path);
        }

        $data=$request->all();
        $data['photo']=$path;
        $data['slug']=$slug;
        $data['added_by']='admin';
        $data['user_id']=auth('admin')->user()->id;
        $data['offer_price']=$request->price-($request->price*$request->discount)/100;
        $store=Product::create($data);
        if ($store) {
            return redirect()->route('product.index')->with('success',"Product Created Successfully!");
        }
        else{
            return redirect()->back()->with('error',"Something wrong!");
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
        $data=Product::findorfail($id);
        if ($data) {
            return view('backend.product.edit',compact('data'));
        }
        else{
            return back()->with('error',"Product Not Found");
        }
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
        $update_id=Product::findorfail($id);
        if ($update_id) {
            $request->validate([
                'title'=>'required',
                'summary'=>'required',
                'description'=>'required',
                'stock'=>'required',
                'price'=>'required|numeric',
                'discount'=>'required|numeric',
                'size'=>'required',
                'conditions'=>'required',
                'status'=>'required',
                'brand_id'=>'required',
                'cat_id'=>'required',
            ]);

            $slug=Str::slug($request->title, '-');

            if ($request->photo) {
                if (File::exists($request->old_photo)) {
                       unlink($request->old_photo);
                }
                $file=$request->photo;
                $filename=uniqid().'.'.$file->getClientOriginalExtension();
                Image::make($file)->resize(300,450)->save('file/img/product/'.$filename);
                $path="file/img/product/$filename";

                $data=$request->all();
                $data['photo']=$path;
                $data['offer_price']=$request->price-($request->price*$request->discount)/100;
                $update=$update_id->fill($data)->save();
                if ($update) {
                    return redirect()->route('product.index')->with('success',"Product Updated Successfully!");
                }
                else{
                    return redirect()->back()->with('error',"Something went wrong!");
                }
            }else{
                $data=$request->all();
                $data['photo']=$request->old_photo;
                $data['slug']=$slug;
                $data['added_by']='admin';
                $data['user_id']=auth('admin')->user()->id;
                $data['offer_price']=$request->price-($request->price*$request->discount)/100;
                $update=$update_id->fill($data)->save();
                if ($update) {
                    return redirect()->route('product.index')->with('success',"Product Updated Successfully!");
                }
                else{
                    return redirect()->back()->with('error',"Something went wrong!");
                }
            }
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
        $data=Product::findorfail($id);
        @unlink(public_path('/').$data->photo);
        $data->delete();

        return redirect()->back()->with('success', "Product Deleted!");
    }
}
