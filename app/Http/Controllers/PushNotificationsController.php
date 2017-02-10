<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PushNotificationsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:push-notification');
    }

    /**
     * Return the admin view for push-notifications.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Get all the posts.
        $posts = Post::all();

        return view('admin.push-notifications', compact('posts'));
    }

    /**
     * Submit a new post.
     *
     * @param Request $request
     */
    public function submit(Request $request){

        $data = $request->all();

        $post = Post::createPost($data);

        dd($post);
    }

}
