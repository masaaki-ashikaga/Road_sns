@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/images/' .$post->post_image) }}" height="400" class="img-fluid">
                        {{-- <img src="/image/{{ $post->post_image }}" height="400" class="img-fluid"> --}}
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div>
                                <div class="d-flex">
                                    @if($user->profile_image)
                                    <img src="{{ asset('storage/images/' .$user->profile_image) }}" class="rounded-circle" width="70" height="70">
                                    {{-- <img src="/image/{{ $user->profile_image }}" class="rounded-circle" width="70" height="70"> --}}
                                    @else
                                    <img src="/image/test_user.jpg" class="rounded-circle" width="100" height="100">
                                    @endif
                                    <div class="mt-3 mr-3 ml-3 d-flex flex-column">
                                        <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                                        <p class="text-secondary">{{ $user->account_name }}</p>
                                    </div>
                                </div>
                            <p class="card-text pt-3">{{ $post->text }}</p>
                            </div>
                            <div class="text-left pt-4">
                                <div class="d-flex">
                                    @if(Auth::id() === $user->id || Auth::user()->admin === 1)
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="text-dark mr-4">
                                            <i class="fas fa-ellipsis-v fa-2x"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}" class="mb-0" onSubmit="return postDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="dropdown-item">編集</a>
                                                <button type="submit" class="dropdown-item del-btn">削除</button>
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                    <?php //dd(array_column($post->favorite->toArray(), 'user_id')) ?>
                                    @if(!in_array(Auth::user()->id, array_column($post->favorite()->get()->toArray(), 'user_id'), TRUE))
                                    <form action="{{ route('favorites.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <button type="submit" class="btn p-0 border-0 text-dark"><i class="far fa-heart fa-2x"></i></button>
                                    </form>
                                    @else
                                    <form action="{{ route('favorites.destroy', ['favorite' => array_column($post->favorite()->get()->toArray(), 'id', 'user_id')[Auth::user()->id]]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 border-0 text-danger"><i class="far fa-heart fa-2x"></i></button>
                                    </form>
                                    @endif
                                    <a href="#" class="text-dark ml-4"><i class="far fa-comment fa-2x"></i></a>
                                </div>
                                <p class="pt-3">{{ $favorite_count }} 人が「いいね！」しました。</p>
                                <p>{{ $comment_count }} 件のコメントがあります。</p>
                                <p class="card-text"><small class="text-muted">{{ $post->created_at }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4 mb-4">
                <div class="card-header" id="#">
                    コメントを追加
                </div>
                <div class="card-body">
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="d-flex">
                                <label for="comment">コメント</label>
                                @if($errors->has('comment'))
                                <p class="text-danger font-weight-bold ml-4 mb-0">{{ $errors->first('comment') }}</p>
                                @endif
                            </div>
                          <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                          <input type="hidden" name="post_id" value="{{ $post->id }}">
                          <input type="text" class="form-control" id="comment" name="comment">
                        </div>
                        <input type="submit" value="投稿する" class="btn btn-primary">
                    </form>
                </div>
            </div>
            @foreach($comments as $comment)
            <div class="card">
                <div class="card-haeder p-3 w-100">
                    <div class="d-flex">
                        @if($comment->user->profile_image)
                        <img src="{{ asset('storage/images/' .$comment->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                        {{-- <img src="/image/{{ $comment->user->profile_image }}" class="rounded-circle" width="50" height="50"> --}}
                        @else
                        <img src="/image/test_user.jpg" class="rounded-circle" width="50" height="50">
                        @endif
                        <div class="mr-3 ml-3 d-flex flex-column">
                            <h5 class="mb-0 font-weight-bold">{{ $comment->user->name }}</h5>
                            <a href="{{ route('users.show', ['user' => $comment->user->id]) }}" class="text-secondary">{{ $comment->user->account_name }}</a>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    </div>
                    @if(Auth::id() === $comment->user_id || Auth::user()->admin)
                    <div class="d-flex">
                        <a href="{{ route('comments.edit', ['comment' => $comment->id]) }}" class="mr-3 btn btn-outline-secondary">編集</a>
                        <form action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="POST" onSubmit="return commentDelete()">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-outline-secondary" value="削除">
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function commentDelete()
    {
        'use strict';
        if(window.confirm('コメントを削除しますか？')){
            return true;
        } else{
            return false;
        }
    }

    function postDelete()
    {
        'use strict';
        if(window.confirm('投稿を削除しますか？')){
            return true;
        } else{
            return false;
        }
    }
</script>

@endsection