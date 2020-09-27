@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mt-4 mb-4">
                <div class="card-header">
                    ブランドを追加
                </div>
                <div class="card-body">
                    <form action="{{ route('brands.update', ['brand' => $brand->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          <label for="name">ブランド名</label>
                          <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}">
                        </div>
                        <div class="form-group">
                          <label for="text">ブランド紹介</label>
                          <input type="text" class="form-control" id="text" name="text" value="{{ $brand->text }}">
                        </div>
                        <div class="form-group pt-3 pb-3">
                            <input type="file" class="form-control-file" id="brand_image" name="brand_image">
                        </div>
                        <input type="submit" class="btn btn-primary" value="編集する">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection