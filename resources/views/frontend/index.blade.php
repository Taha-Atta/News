@extends('layouts.frontend.app')



@section('title','Home')

@push('headers')
 <link rel="canonical" href="{{url()->full()}}">
@endpush

@section('body')
    @php
        $lateest_post = $posts->take(4);
    @endphp
    <!-- Top News Start-->
    <div class="top-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6 tn-left">
                    <div class="row tn-slider">
                        @foreach ($lateest_post as $post)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img  style="width: 540;height:380px"src="{{asset( $post->images->first()->path) }}" />
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
                <div class="col-md-6 tn-right">
                    <div class="row">
                        @foreach ($lateest_post as $post)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img style="width: 280px;height:195px" src="{{asset( $post->images->first()->path) }}" />
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top News End-->

    {{-- <!-- Category News Start-->
    <div class="cat-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Sports</h2>
                    <div class="row cn-slider">
                        <div class="col-md-6">
                            <div class="cn-img">
                                <img src="{{ asset('assets/frontend') }}/img/news-350x223-1.jpg" />
                                <div class="cn-title">
                                    <a href="">Lorem ipsum dolor sit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cn-img">
                                <img src="{{ asset('assets/frontend') }}/img/news-350x223-2.jpg" />
                                <div class="cn-title">
                                    <a href="">Lorem ipsum dolor sit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cn-img">
                                <img src="{{ asset('assets/frontend') }}/img/news-350x223-3.jpg" />
                                <div class="cn-title">
                                    <a href="">Lorem ipsum dolor sit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2>Technology</h2>
                    <div class="row cn-slider">
                        <div class="col-md-6">
                            <div class="cn-img">
                                <img src="{{ asset('assets/frontend') }}/img/news-350x223-4.jpg" />
                                <div class="cn-title">
                                    <a href="">Lorem ipsum dolor sit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cn-img">
                                <img src="{{ asset('assets/frontend') }}/img/news-350x223-5.jpg" />
                                <div class="cn-title">
                                    <a href="">Lorem ipsum dolor sit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cn-img">
                                <img src="{{ asset('assets/frontend') }}/img/news-350x223-1.jpg" />
                                <div class="cn-title">
                                    <a href="">Lorem ipsum dolor sit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Category News End--> --}}

    <!-- Category News Start-->
    <div class="cat-news">
        <div class="container">
            <div class="row">
                @foreach ($categories_with_posts as $category)
                    <div class="col-md-6">
                        <h2>{{ $category->name }}</h2>
                        <div class="row cn-slider">
                            @foreach ($category->posts as $post)
                                <div class="col-md-6">
                                    <div class="cn-img">
                                        <img  style="width: 280px;height:200px" src="{{asset( $post->images->first()->path) }}" />
                                        <div class="cn-title">
                                            <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- Category News End-->

    <!-- Tab News Start-->
    <div class="tab-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#featured">Poupler News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#popular">Oldest News</a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div id="featured" class="container tab-pane active">
                            @foreach ($great_posts_commemt as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img style="width: 150px;height:100px" src="{{asset( $post->images->first()->path) }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a
                                            href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}({{ $post->comments_count }})</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="popular" class="container tab-pane fade">
                            @foreach ($old_news as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img style="width: 150px;height:100px"src="{{asset( $post->images->first()->path) }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#m-viewed">Latest News</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#m-recent">Most Recent</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="m-viewed" class="container tab-pane active">
                            @foreach ($lateest_post as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img style="width: 150px;height:100px" src="{{asset( $post->images->first()->path) }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="m-recent" class="container tab-pane fade">
                            @foreach ($most_views as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img style="width: 150px;height:100px" src="{{asset( $post->images->first()->path) }} " />
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}.
                                            ({{ $post->num_of_views }})</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab News Start-->

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img style="width: 280px;height:200px" src="{{asset( $post->images->first()->path) }}" />
                                    <div class="mn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $posts->links() }}
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Read More</h2>
                        <ul>
                            @foreach ($read_more_posts as $post)
                                <li>
                                    <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
