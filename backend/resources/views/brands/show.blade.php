@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div>
                        <div class="p-3 d-flex">
                            <img src="/image/{{ $brand->brand_image }}" class="rounded-circle" width="100" height="100">
                            <div class="ml-2">
                                <div class="d-flex">
                                    <div class="mt-3 mr-3 ml-3 d-flex flex-column">
                                        <h4 class="mb-0 font-weight-bold">{{ $brand->name }}</h4>
                                        <p class="text-secondary">{{ $brand->text }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="font-weight-bold ml-3">投稿 {{ $post_count }} 件</p>
                                </div>
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
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}"><img src="/image/{{ $post->post_image }}" width="300" class="img-fluid"></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection