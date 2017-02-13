<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
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
        $posts = Post::paginate(10);

        return view('admin/push-notifications', compact('posts'));
    }

    /**
     * Submit a new post.
     *
     * @param Request $request
     *
     * @return $this->index()
     */
    public function submit(Request $request){

        $data = $request->all();

        // Create a validator with the form data.
        $v = ($this->postValidiator($data));

        // Check that post data passes validator.
        if($v->passes()){

            Post::createPost($data);

            return redirect('admin/push-notifications')->withErrors($v);
        }else{
            return redirect('admin/push-notifications')->withErrors($v);
        }
    }

    public function remove($post_id){
        Post::destroy($post_id);
        return redirect('admin/push-notifications');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function postValidiator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|max:255|unique:posts',
            'post_date' => 'required|max:255',
            'content' => 'required|min:50',
        ]);
    }
}
