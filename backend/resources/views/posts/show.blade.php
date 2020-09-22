@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <img src="/image/{{ $post->post_image }}" height="400" class="img-fluid">
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div>
                                <div class="d-flex">
                                    <img src="/image/{{ $user->profile_image }}" class="rounded-circle" width="70" height="70">
                                    <div class="mt-3 mr-3 ml-3 d-flex flex-column">
                                        <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                                        <p class="text-secondary">{{ $user->account_name }}</p>
                                    </div>
                                </div>
                            <p class="card-text pt-3">{{ $post->text }}</p>
                            </div>
                            <div class="text-left pt-4">
                                <a href="#" class="text-dark mr-3"><i class="far fa-heart fa-2x"></i></a>
                                <a href="#" class="text-dark"><i class="far fa-comment fa-2x"></i></a>
                                <p class="pt-3">{{ $favorite_count }} 人が「いいね！」しました。</p>
                                <p>{{ $comment_count }} 件のコメントがあります。</p>
                                <p class="card-text"><small class="text-muted">{{ $post->created_at }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4 mb-4">
                <div class="card-header">
                    コメントを追加
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                          <label for="comment">コメント</label>
                          <input type="text" class="form-control" id="comment">
                        </div>
                        <button type="submit" class="btn btn-primary">投稿する</button>
                    </form>
                </div>
            </div>
            @foreach($comments as $comment)
            <div class="card">
                <div class="card-haeder p-3 w-100">
                    <div class="d-flex">
                        <img src="/image/{{ $comment->user->profile_image }}" width="50" height="50">
                        <div class="mr-3 ml-3 d-flex flex-column">
                            <h5 class="mb-0 font-weight-bold">{{ $comment->user->name }}</h5>
                            <p class="text-secondary">{{ $comment->user->account_name }}</p>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    </div>
                    @if(Auth::id() === $comment->user_id)
                        <a href="#" class="mr-3">編集</a>
                        <a href="#">削除</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection