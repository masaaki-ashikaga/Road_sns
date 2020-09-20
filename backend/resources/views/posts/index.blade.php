@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-9 text-center" style="background: #ccc;">
            <div class="card mb-5">
                <div class="card-header">
                    <p>ここにユーザー名をいれる</p>
                </div>
                <img src="/image/test_post.jpg" class="card-img-top">
                <div class="card-body">
                    <div class="text-left">
                        <a href="#" class="text-dark mr-3"><i class="far fa-heart fa-2x"></i></a>
                        <a href="#" class="text-dark"><i class="far fa-comment fa-2x"></i></a>
                        <p>●●人が「いいね！」しました。</p>
                        <p>投稿の文章をここに入れる。</p>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">col-sm-3</div>
    </div>
</div>
@endsection


