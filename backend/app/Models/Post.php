<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Post extends Model
{
    protected $fillable = [
        'text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function createPost($request)
    {
        $user_id = Auth::id();
        $this->user_id = $user_id;
        $this->brand_id = $request->brand_id;
        $this->text = $request->text;
        $this->post_image = $request->post_image;
        $this->save();
        return;
    }

    public function updatePost($request, $post)
    {
        $new_post = $this::find($post->id);
        $new_post->brand_id = $request->brand_id;
        $new_post->text = $request->text;
        $new_post->post_image = $request->post_image;
        $new_post->update();
        return;
    }

    public function getPost($followed_users_id)
    {
        foreach($followed_users_id as $followed_user_id){
            $posts[] = Post::with('user')->where('user_id', $followed_user_id->followed_id)->orderBy('created_at', 'DESC')->first();
        }
        return $posts;
    }
}
