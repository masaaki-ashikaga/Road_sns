@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-end mb-3">
                    <form action="{{ route('brands.index') }}" method="GET" class="form-inline">
                        <input class="form-control mr-sm-2" name="search" type="search" placeholder="ブランド名から探す" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                @foreach ($brands as $brand)
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="/image/{{ $brand->brand_image }}" class="rounded-circle" width="50" height="50">
                            <div class="ml-3 d-flex flex-column">
                                <h5 class="font-weight-bold mb-1">{{ $brand->name }}</h5>
                                <p class="mb-0">{{ $brand->text }}</p>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <a href="{{ route('brands.show', ['brand' => $brand->id]) }}" class="d-flex align-items-center btn btn-outline-dark p-2">ブランド詳細</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
            {{ $brands->links() }}
        </div>
    </div>
@endsection