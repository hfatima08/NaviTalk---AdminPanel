<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{

    // call login page as landing page
    public function index()
    {
        return view('main.login');
    }
   
    // check login credentials
    public function process_login(Request $request)
    {
        $user=['Admin'];
        $pass=['Admin123'];

        if((in_array($request->username,$user)) and (in_array($request->password,$pass))){
            session(['user' => $request->username]);

            return redirect('/dashboard');
        }else{
            session()->flash('message','Invalid Username or Password!');
            return redirect('/');
        }
    }

    // check user session to redirect on dashboard
    public function dashboard(Request $request)
    {
        if(!empty($request->session()->get('user'))){
        return view('main.dashboard');
        }
        else{
            $request->session()->flash('message','You have to login first!');
            return redirect('/');
        }
    }

    // logout function
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->flash('success','You have successfully logged out!');
        return redirect('/');
    }

    //show blind user page
    public function user_record(){
        return view('main.blind_user.userrecord');
    }

    // show volunteers page
    public function vol_record(){
        return view('main.volunteer.volunteers');
    }

    //show all records page
    public function all_record(){
        return view('main.allrecords');
    }
}
