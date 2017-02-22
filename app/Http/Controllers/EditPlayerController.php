<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class EditPlayerController extends Controller
{

    public function index(User $user){
        return view('admin/edit-player', compact('user'));
    }
}
