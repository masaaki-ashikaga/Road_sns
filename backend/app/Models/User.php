<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_name',
        'name',
        'profile_image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function followers()
    {
        //followed_idが自分のデータのうちの、following_idを取得する。
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        //following_idが自分のデータのうちの、followed_idを取得する。
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    public function follow($user_id)
    {
        return $this->follows()->attach($user_id);
    }

    public function unfollow($user_id)
    {
        return $this->follows()->detach($user_id);
    }

    public function isFollowing($user_id)
    {
        //自分がフォローしているユーザーを取得→その中に指定のユーザーIDがあるか判定
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    public function isFollowed($user_id)
    {
        //自分をフォローしているユーザーを取得→その中に指定のユーザーIDがあるか判定
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function updateUser($request)
    {
        $file_name = $request->file('profile_image')->store('public/images');
        $new_user = User::find($request->id);
        $new_user->account_name = $request->account_name;
        $new_user->name = $request->name;
        $new_user->text = $request->text;
        $new_user->profile_image = basename($file_name);
        $new_user->update();
        return;
    }
}
