@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mt-4 mb-4">
                <div class="card-header">
                    コメントを編集
                </div>
                <div class="card-body">
                    <form action="{{ route('comments.update', ['comment' => $comment->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="d-flex">
                                <label for="comment">コメント</label>
                                @if($errors->has('comment'))
                                <p class="text-danger font-weight-bold ml-4 mb-0">{{ $errors->first('comment') }}</p>
                                @endif
                            </div>
                            <input type="text" class="form-control" id="comment" name="comment" value="{{ $comment->comment }}">
                        </div>
                        <input type="submit" class="btn btn-primary" value="投稿する">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection