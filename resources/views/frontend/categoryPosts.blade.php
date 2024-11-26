@extends('layouts.frontend.app')


@section('title')
    {{ $category->name }}
@endsection

@push('headers')
 <link rel="canonical" href="{{url()->full()}}">
@endpush
@section('body')


@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
<li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection

<div class="main-news">
    <div class="container">
        <h2></h2>
        <h2></h2>
        <h2>{{ $category->name }} posts</h2>
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    @if ($posts)
                        @foreach ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ $post->images()->first()->path }}" />
                                    <div class="mn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}"
                                            title="{{ $post->title }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert-info">This Category not have posts yet</div>
                    @endif


                </div>
                {{ $posts->links() }}
            </div>

            <div class="col-lg-3">
                <div class="mn-list">
                    <h2>Other Categories</h2>
                    <ul>
                        @foreach ($categories as $category)
                            <li><a href="{{ route('frontend.category.posts', $category->slug) }}"
                                    title="{{ $category->name }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
