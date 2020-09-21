@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div>
                        <div class="p-3 d-flex">
                            <img src="/image/{{ $user->profile_image }}" class="rounded-circle" width="100" height="100">
                            <div class="ml-2">
                                <div class="d-flex">
                                    <div class="mt-3 mr-3 ml-3 d-flex flex-column">
                                        <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                                        <p class="text-secondary">{{ $user->account_name }}</p>
                                    </div>
                                    <div class="p-3 d-flex flex-column justify-content-between">
                                        @if(Auth::id() === $user->id)
                                            <a href="#" class="btn btn-primary">プロフィールを編集</a>
                                            @else
                                            @if(!$following)
                                                <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">フォローする</button>
                                                </form>
                                                @else
                                                <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-dark">フォロー解除</button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="font-weight-bold mr-4">投稿 {{ $post_count }} 件</p>
                                    <p class="font-weight-bold mr-4">フォロワー {{ $following_count }} 人</p>
                                    <p class="font-weight-bold">フォロー中 {{ $followed_count }} 人</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-3 d-flex flex-wrap text-center">
                    @foreach($posts as $post)
                    <div class="col-md-4 pt-5">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}"><img src="/image/{{ $post->post_image }}" width="300"></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection