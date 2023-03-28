<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=User::orderBy('id','DESC')->get();
        return view('backend.user.index',compact('data'));
    }

    public function userStatus(Request $request)
    {
        //dd($request->all());
        if ($request->mode=='true') {
            DB::table('users')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('users')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.user.create');
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
            'full_name'=>'required',
            'username'=>'required',
            'email'=>'email|required|unique:users',
            'password'=>'required|min:6',
            'phone'=>'required',
            'address'=>'required',
            'photo'=>'required',
            'role'=>'required',
            'status'=>'required',
        ]);

        $data=$request->all();
        $data['password']=Hash::make($request->password);
        $store=User::create($data);
        if ($store) {
            toastr()->success('User Created Successfully');
            return redirect()->route('user.index');
        }
        else{
            toastr()->error('An error has occurred please try again!');
            return redirect()->route('user.index');
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
        //
    }
}
