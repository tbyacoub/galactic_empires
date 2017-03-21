<?php

namespace App\Http\Controllers;

use App\Http\Requests\PushNotificationsRequest;
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
     *
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
    public function store(PushNotificationsRequest $request)
    {
        Post::createPost($request->all());

        return back();
    }


    /**
     * Updates the selected post
     *
     * @param PushNotificationsRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PushNotificationsRequest $request, Post $post)
    {
        //TODO
        return back();
    }

    /**
     * Destroys the selected post
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
}
