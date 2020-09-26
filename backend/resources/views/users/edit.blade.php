@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mt-4 mb-4">
                <div class="card-header">
                    プロフィールを編集
                </div>
                <div class="card-body">
                    <div class="d-flex mb-4">
                        <img src="/image/{{ $user->profile_image }}" class="rounded-circle mr-3" width="40" height="40">
                        <h4>{{ $user->account_name }}</h4>
                    </div>
                    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                          <label for="account_name">アカウント名</label>
                          <input type="text" class="form-control" id="account_name" name="account_name" value="{{ $user->account_name }}">
                        </div>
                        <div class="form-group">
                          <label for="name">名前</label>
                          <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                          <label for="text">自己紹介</label>
                          <textarea class="form-control" id="text" name="text"></textarea>
                        </div>
                        <div class="form-group pt-3 pb-3">
                            <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                        </div>
                        <input type="submit" class="btn btn-primary" value="編集する">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection