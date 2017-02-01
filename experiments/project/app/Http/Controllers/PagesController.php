<?php

namespace App\Http\Controllers;


class PagesController extends Controller
{
    public function home()
    {
        $people = ['Taylor', 'Matt', 'Jeffrey'];

        return view('welcome', compact('people')); //array with key of people and a value with the data associated with that variable
    }

    public function about()
    {
        return view('about');
    }
}
