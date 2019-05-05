<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\ModelUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Session::get('login'))
        {
            return redirect('index')->with('alert','Silahkan login terlebih dahulu');
        }
        else{
            return view('surevey_list');
        }
        return view('index');
    }

    
    public function LoginPost(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $data = user::where('email',$email)->first();
        if($data) //check email ada atau tidak
        {
            if(Hash::check($password,$data->password))
            {
                Session::put('full_name',$data->full_name);
                Session::put('email',$data->email);
                Session::put('login',TRUE);
     
                return redirect('surevey_list');
            }
            else
            {
                return redirect('index')->with('alert','Password atau Email yang anda masukan salah !!! ' );
            }
        }
    }

    public function RegisterPost(Request $request)
    {   
        $this->validate($request, [
            'full_name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:users',
            'password'=>'required',
            'repassword'=>'required|same:password'
        ]);

        $data = new user();
        $data->full_name = $request->full_name;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->save();
        return redirect('index')->with('alert-success','Berhasil Register silahkan login.'); 
    
    }

    public function Logout()
    {
        Session::Flush();
        return redirect('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
