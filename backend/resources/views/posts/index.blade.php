@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-9 text-center" style="background: #ccc;">
            @foreach($posts as $post)
            <?php //dd(array_column($post->favorite()->get()->toArray(), 'user_id')); ?>
            <div class="card mb-5">
                <div class="card-header">
                    <div class="d-flex">
                        <img src="/image/{{ $post->user->profile_image }}" class="rounded-circle" width="50" height="50">
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
                    </div>
                    <p></p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-sm-3">col-sm-3</div>
    </div>
</div>
@endsection


