<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    public function index(Request $request){
    	$user = $request->user();
    	$planet = $user->planets()->first();
    	$buildings = $planet->buildingsOfType('resource');
    	
    	return view('content.resources', compact('user', 'planet', 'buildings'));
   }
}
