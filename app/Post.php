<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'post_date',
    ];

    /**
     * Get the User Model that created the post.
     *
     * @return User that created the Post (Admin User)
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * Create a new post instance.
     *
     * @param  array  $data
     * @return Post the created Post
     */
    protected function createPost(array $data)
    {

        $post = new Post;
        $post->title = $data['title'];
        $post->post_date = $data['post_date'];
        $post->content = $data['content'];
        $post->user_id = Auth::id();
        $post->save();

        return redirect('admin/push-notifications');
    }
}
