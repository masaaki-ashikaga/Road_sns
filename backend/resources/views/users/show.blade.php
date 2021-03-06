@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div>
                        <div class="p-3 d-flex">
                            @if($user->profile_image)
                            {{-- <img src="/image/{{ $user->profile_image }}" class="rounded-circle" width="100" height="100"> --}}
                            <img src="{{ asset('storage/images/' .$user->profile_image) }}" class="rounded-circle" width="100" height="100">
                            @else
                            <img src="/image/test_user.jpg" class="rounded-circle" width="100" height="100">
                            @endif
                            <div class="ml-2">
                                <div class="d-flex">
                                    <div class="mt-3 mr-3 ml-3 d-flex flex-column">
                                        <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                                        <p class="text-secondary">{{ $user->account_name }}</p>
                                    </div>
                                    <div class="p-3 d-flex flex-column justify-content-between">
                                        @if(Auth::id() === $user->id)
                                        <div class="d-flex">
                                            <a href="{{ route('users.edit', ['user' => Auth::user()->id]) }}" class="btn btn-primary">プロフィールを編集</a>
                                            <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}" onSubmit="return accountDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger ml-3">アカウントを削除</button>
                                            </form>
                                        </div>
                                        @else
                                            <div class="d-flex">
                                                @if(Auth::user()->admin === 1)
                                                <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary">プロフィールを編集</a>
                                                <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}" onSubmit="return accountDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger ml-3 mr-3">アカウントを削除</button>
                                                </form>
                                                @endif
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
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between" style="width: 400px;">
                                    <p class="font-weight-bold mr-4">投稿 {{ $post_count }} 件</p>
                                    <p class="font-weight-bold mr-4"><a href="{{ route('followed', ['user' => $user->id]) }}" class="text-dark">フォロワー {{ $followed_count }} 人</a></p>
                                    <p class="font-weight-bold"><a href="{{ route('following', ['user' => $user->id]) }}" class="text-dark">フォロー中 {{ $following_count }} 人</a></p>
                                </div>
                                @if($user->text)
                                <p>{{ $user->text }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if($post_count === 0)
                <div class="card mt-4">
                    <div class="card-header">
                        <h4 class="mb-0">投稿はまだありません。</h4>
                    </div>
                </div>
                @endif
                <div class="pt-3 d-flex flex-wrap text-center">
                    @foreach($posts as $post)
                    <div class="col-md-4 pt-5">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                            <img src="{{ asset('storage/images/' .$post->post_image) }}" width="300" class="img-fluid">
                            {{-- <img src="/image/{{ $post->post_image }}" width="300" class="img-fluid"> --}}
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

<script>
function accountDelete()
{
    'use strict';
    if(window.confirm('削除すると元に戻りませんが、本当にアカウントを削除しますか？')){
        return true;
    } else{
        return false;
    }
}
</script>

@endsection