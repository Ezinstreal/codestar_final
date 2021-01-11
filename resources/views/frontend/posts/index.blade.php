@extends('frontend.layouts.app')

@section('title','Sa-blog')

@section('main')

<section class="posts">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="quote posts-item">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="quote__title"><i class="fas fa-quote-left"></i>
                                 php artisan make:controller frontend/PostControllerphp artisan make:controller frontend/PostController
                                 rontend/PostController
                                 rontend/PostController
                            <i class="fas fa-quote-right"></i></div>
                            <div class="quote__description">Unknown</div>
                        </div>
                        <div class="item"><span>php artisan make:controller frontend/PostControllerphp artisan make:controller frontend/PostController</span></div>
                        <div class="item"><span>php artisan make:controller frontend/PostControllerphp artisan make:controller frontend/PostController</span></div>
                    </div>
                </div>

                @foreach ($posts as $item)
                <div class="posts-item">
                    <div class="row">
                        <div class="col-2">
                            <div class="posts-item__img">
                                <a href="{{ route('users.mypage',$item->users->first()->profile->nickname) }}">
                                    <img class="w-100 h-100" src="{{ asset('upload/'.$item->users->first()->profile->image) }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="posts-item__title">
                                        <a href="{{ route('posts.show',$item->slug) }}">{{ $item->title }}</a>
                                    </div>
                                     <div class="posts-item__tag">
                                         @foreach ($item->tags as $tag)
                                            <a href="{{ route('posts.tag',$tag->slug) }}">{{ $tag->name }}</a>
                                         @endforeach
                                    </div>
                                    <div class="posts-item__description">
                                        {{ $item->description }}
                                     </div>
                                     <div class="posts-item__more">
                                        <a href="{{ route('users.mypage',$item->users->first()->profile->nickname) }}">{{ $item->users->first()->name }}</a>

                                        @if($item->created_at->diff(now())->y>0)
                                        viết {{ $item->created_at->diff(now())->y }} năm trước.
                                        @elseif($item->created_at->diff(now())->m>0)
                                        viết {{ $item->created_at->diff(now())->m }} tháng trước.
                                        @elseif($item->created_at->diff(now())->d>0)
                                        viết {{ $item->created_at->diff(now())->d }} ngày trước.
                                        @elseif($item->created_at->diff(now())->h>0)
                                        viết {{ $item->created_at->diff(now())->h }} giờ trước.
                                        @elseif($item->created_at->diff(now())->i>0)
                                        viết {{ $item->created_at->diff(now())->i }} phút trước.
                                        @else
                                        vừa đăng
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="posts-item__options">
                                         {{ count($item->usersSavedPost) }} <i class="fas fa-bookmark"></i>
                                         {{ count($item->comments) }} <i class="fas fa-comment"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="row justify-content-md-center">
                    <div class="col-md-2">
                        <div class="btnPaginate">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 offset-md-1">
                @if (Auth::user())
                <div class="posts-right-user posts-item">
                    <div class="row g-0">
                        <div class="col-lg-5">
                            <div class="posts-right-user__img">
                                <img class="w-100 h-100" src="{{ asset('upload/'. $user_me->profile->image) }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="posts-right-user__title">
                                <span>{{ $user_me->name }}</span>
                            </div>
                            <p><span>{{ count($user_me->posts) }} </span> bài viết.</p>
                            <p><span>{{ count($user_me->follows) }} </span> người theo dõi.</p>
                        </div>
                    </div>
                </div>
                @endif
                <div id="holdRight" class="posts-right">
                    <div class="posts-right-tag posts-item">
                        <div class="posts-right-tag__title">
                            <i class="fas fa-tags"></i> Chủ đề nổi bật
                        </div>
                        <div class="posts-right-tag-item">
                            @foreach ($tag_me as $item)
                            <a href="{{ route('posts.tag',$item->slug) }}">{{ $item->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="posts-right-author posts-item">
                        <div class="posts-right-author__title">
                            <i class="fas fa-trophy"></i> Tác giả bài viết hay
                        </div>
                        <div class="posts-right-author-item">
                            <a href="#">
                                <img src="{{ asset('images/s.png') }}" alt="">
                                <span>Posts Author 1</span>
                            </a>
                        </div>
                        <div class="posts-right-author-item">
                            <a href="#">
                                <img src="{{ asset('images/s.png') }}" alt="">
                                <span>Posts Author 1</span>
                            </a>
                        </div>
                        <div class="posts-right-author-item">
                            <a href="#">
                                <img src="{{ asset('images/s.png') }}" alt="">
                                <span>Posts Author 1</span>
                            </a>
                        </div>
                        <div class="posts-right-author-item">
                            <a href="#">
                                <img src="{{ asset('images/s.png') }}" alt="">
                                <span>Posts Author 1</span>
                            </a>
                        </div>
                        <div class="posts-right-author-item">
                            <a href="#">
                                <img src="{{ asset('images/s.png') }}" alt="">
                                <span>Posts Author 1</span>
                            </a>
                        </div>
                    </div>
                    <div class="posts-right-place posts-item">
                        <div class="posts-right-place__title">
                            <i class="fas fa-map-marker-alt"></i> Địa điểm nổi bật
                        </div>
                        @foreach ($place_me as $item)
                        <div class="posts-right-place-item">
                            <a href="#">{{ $item->name }}</a>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endsection
@section('js')
<script src="{{asset('js/jquery.lockfixed.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            dots:false,
            autoplay:false,
            loop:true,
            margin:10,
            responsive:{
                0:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        });
        if (screen.width > 500) {
            $.lockfixed("#holdRight", {offset: {top: 0, bottom: 0} });
        }
    });

</script>
@endsection
