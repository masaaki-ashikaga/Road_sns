<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function createComment($request)
    {
        $this->user_id = $request->user_id;
        $this->post_id = $request->post_id;
        $this->comment = $request->comment;
        $this->save();
        return;
    }

    public function updateComment($request, $comment)
    {
        $new_comment = $this::find($comment->id);
        $new_comment->comment = $request->comment;
        $new_comment->update();
        return;
    }
}
