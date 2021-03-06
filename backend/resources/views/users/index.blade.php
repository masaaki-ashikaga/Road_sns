@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-end mb-3">
                    <form action="{{ route('users.index') }}" method="GET" class="form-inline">
                        <input class="form-control mr-sm-2" name="search" type="search" placeholder="ユーザー名から探す" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                @foreach ($users as $user)
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            @if($user->profile_image != null)
                            <img src="{{ asset('storage/images/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                            {{-- <img src="/image/{{ $user->profile_image }}" class="rounded-circle" width="50" height="50"> --}}
                            @else
                            <img src="/image/test_user.jpg" class="rounded-circle" width="50" height="50">
                            @endif
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $user->name }}</p>
                                <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->account_name }}</a>
                            </div>
                            @if (auth()->user()->isFollowed($user->id))
                                <div class="px-2">
                                    <span class="px-1 bg-secondary text-light">フォローされています</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-end flex-grow-1">
                                @if (auth()->user()->isFollowing($user->id))
                                    <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-outline-dark">フォロー解除</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" class="btn btn-primary">フォローする</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection