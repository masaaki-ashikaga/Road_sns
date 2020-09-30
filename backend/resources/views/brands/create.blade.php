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
                    <form action="{{ route('brands.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="d-flex">
                                <label for="name">ブランド名</label>
                                @if($errors->has('name'))
                                <p class="text-danger font-weight-bold ml-4 mb-0">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <label for="text">ブランド紹介</label>
                                @if($errors->has('text'))
                                <p class="text-danger font-weight-bold ml-4 mb-0">{{ $errors->first('text') }}</p>
                                @endif
                            </div>
                            <input type="text" class="form-control" id="text" name="text">
                        </div>
                        <div class="form-group pt-3 pb-3">
                            @if($errors->has('brand_image'))
                            <p class="text-danger font-weight-bold mb-1">{{ $errors->first('brand_image') }}</p>
                            @endif
                            <input type="file" class="form-control-file" id="brand_image" name="brand_image">
                        </div>
                        <input type="submit" class="btn btn-primary" value="追加する">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection