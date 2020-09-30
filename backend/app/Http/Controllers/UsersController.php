<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Post;
use App\Models\Follower;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = User::where('id', '<>', Auth::id());
        if($search !== null){
            $search_split = mb_convert_kana($search, 's');
            $search_split2 = preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY);
            foreach($search_split2 as $value){
                $query->where('name', 'like', '%' . $value . '%');
            }
        };
        $users = $query->paginate(5);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Post $post, Follower $follower)
    {
        $following = auth()->user()->isFollowing($user->id);
        $followed = auth()->user()->isFollowed($user->id);
        $posts = $post->where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        $post_count = count($post->where('user_id', $user->id)->get());
        $following_count = count($follower->where('following_id', $user->id)->get());
        $followed_count = count($follower->where('followed_id', $user->id)->get());
        return view('users.show', compact('user', 'following', 'followed', 'posts', 'post_count', 'following_count', 'followed_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->updateUser($request);
        return redirect(route('users.show', ['user' => $request->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function follow(User $user)
    {
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following){
            $follower->follow($user->id);
            return back();
        }
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user->id);
        if($is_following){
            $follower->unfollow($user->id);
            return back();
        }
    }

    public function followed(User $user)
    {
        $followed = $user->followers()->where('id', '<>', Auth::id())->paginate(5);
        return view('users.followed', compact('followed'));
    }

    public function following(User $user)
    {
        $follows = $user->follows()->where('id', '<>', Auth::id())->paginate(5);
        return view('users.following', compact('follows'));
    }
}
