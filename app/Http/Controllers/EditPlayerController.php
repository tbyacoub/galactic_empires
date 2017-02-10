<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class EditPlayerController extends Controller
{
    public function index($user_id){

        $user = User::find($user_id);

//        dd($user);

        return view('admin/edit-player', compact('user'));
    }
}
