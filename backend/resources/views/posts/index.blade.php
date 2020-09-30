@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 text-center">
            @if($posts != null)
            @foreach($posts as $post)
            @if(auth()->user()->isFollowing($post->user->id))
            <div class="card mb-5">
                <div class="card-header">
                    <div class="d-flex">
                        @if($post->user->profile_image)
                        <img src="/image/{{ $post->user->profile_image }}" class="rounded-circle" width="50" height="50">
                        @else
                        <img src="/image/test_profile.jpg" class="rounded-circle" width="50" height="50">
                        @endif
                        <div class="ml-3 d-flex flex-column">
                            <h5 class="mb-0 font-weight-bold">{{ $post->user->name }}</h5>
                            <a href="{{ route('users.show', ['user' => $post->user->id]) }}" class="text-secondary">{{ $post->user->account_name }}</a>
                        </div>
                    </div>
                </div>
                <img src="/image/{{ $post->post_image }}" class="card-img-top">
                <div class="card-body">
                    <div class="text-left">
                        <div class="d-flex">
                            @if(!in_array(Auth::user()->id, array_column($post->favorite()->get()->toArray(), 'user_id'), TRUE))
                            <form action="{{ route('favorites.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <button class="btn p-0 border-0 text-dark"><i class="far fa-heart fa-2x"></i></button>
                            </form>
                            @else
                            <form action="{{ route('favorites.destroy', ['favorite' => array_column($post->favorite()->get()->toArray(), 'id', 'user_id')[Auth::user()->id]]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn p-0 border-0 text-danger"><i class="far fa-heart fa-2x"></i></button>
                            </form>
                            @endif
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="text-dark ml-4"><i class="far fa-comment fa-2x"></i></a>
                        </div>
                        <p class="mb-0 pt-2">{{ count($post->favorite()->get()) }} 人が「いいね！」しました。</p>
                        <p class="pt-0">{{ count($post->comment()->get()) }} 件のコメントがあります。</p>
                        <p>{{ $post->text }}</p>
                        <p class="card-text"><small class="text-muted">{{ $post->created_at }}</small></p>
                    </div>
                    <p></p>
                </div>
            </div>
            @endif
            @endforeach
            @else
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">フォロワーの投稿がありません。</h4>
                </div>
            </div>
            @endif
        </div>
        <div class="col-sm-4 pt-5">
            <div class="d-flex justify-content-between">
                <h4 class="text-secondary font-weight-bold">ブランド一覧</h4>
                <a href="{{ route('brands.index') }}" class="pr-2">すべて見る</a>
            </div>
            @foreach($brands as $brand)
            <div class="card">
                <a href="{{ route('brands.show', ['brand' => $brand->id]) }}" class="text-dark">
                    <div class="card-header p-3 d-flex">
                        <img src="/image/{{ $brand->brand_image }}" class="rounded-circle" width="50" height="50">
                        <div class="ml-3 d-flex flex-column">
                            <h5 class="mb-1 font-weight-bold">{{ $brand->name }}</h5>
                            <p class="mb-0">{{ $brand->text }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection


