<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class LoginController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function login(){

        return view('authentication.login');
    }

    public function postLogin(Request $request){

        // Authenticate login information.
        Sentinel::authenticate($request->all());

        // Redirect user to appropriate view.
        if(Sentinel::check()){

            // Redirect user on his Role.
            $slug = Sentinel::getUser()->roles()->first()->slug;
            if($slug == 'admin')
                return redirect('/admin');
            if($slug == 'player')
                return redirect('/player');
        }else{
            return redirect('/login');
        }
    }

    public function postLogout(){
        Sentinel::logout();

        return redirect('/login');
    }
}
