<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function planets(Request $request){
        return $request->user()->planets()->get();
    }
}
