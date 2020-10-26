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
        $file_name = $request->file('post_image')->store('public/images');
        $this->user_id = $user_id;
        $this->brand_id = $request->brand_id;
        $this->text = $request->text;
        $this->post_image = basename($file_name);
        $this->save();
        return;
    }

    public function updatePost($request, $post)
    {
        $new_post = $this::find($post->id);
        $file_name = $request->file('post_image')->store('public/images');
        $new_post->brand_id = $request->brand_id;
        $new_post->text = $request->text;
        $new_post->post_image = basename($file_name);
        $new_post->update();
        return;
    }
}
