<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Follower;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $followed_users_id = Follower::where('following_id', Auth::id())->get('followed_id');
        // dd($followed_users_id);
        if(!$followed_users_id->isEmpty()){
            $posts = $post->getPost($followed_users_id);
        } else{
            $posts = null;
        }
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        return view('posts.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $post->createPost($request);
        $user_id = Auth::user()->id;
        return redirect(route('users.show', ['user' => $user_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Comment $comment, Favorite $favorite)
    {
        $user = User::find($post->user_id);
        $comments = $comment->with('user')->where('post_id', $post->id)->get();
        $comment_count = count($comments);
        $favorite_count = count($favorite->where('post_id', $post->id)->get());
        return view('posts.show', compact('post', 'user', 'comments', 'comment_count', 'favorite_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $brands = Brand::all();
        return view('posts.edit', compact('post', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->updatePost($request, $post);
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        $user_id = Auth::user()->id;
        return redirect(route('users.show', ['user' => $user_id]));
    }
}
