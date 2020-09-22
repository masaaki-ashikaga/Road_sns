@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mt-4 mb-4">
                <div class="card-header">
                    写真を投稿
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="text">テキスト</label>
                          <input type="text" class="form-control" id="text" name="text">
                        </div>
                        <div class="form-group">
                            <label for="brand_id">ブランド</label>
                            <select class="form-control" id="brand_id">
                                <option value="">該当するブランドはない</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group pt-3 pb-3">
                            <input type="file" class="form-control-file" id="post_image" name="post_image">
                        </div>
                        <input type="submit" class="btn btn-primary" value="投稿する">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection