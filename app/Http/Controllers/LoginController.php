<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class LoginController extends Controller
{
    public function login(){
        return view('authentication.login');
    }

    public function postLogin(Request $request){

        Sentinel::authenticate($request->all());

        return Sentinel::check();
    }

    public function postLogout(){
        Sentinel::logout();

        return redirect('/login');
    }
}
