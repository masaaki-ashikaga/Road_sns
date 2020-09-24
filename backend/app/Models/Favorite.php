<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function createFavorite($user_id, $post_id)
    {
        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->save();
        return;
    }
}
