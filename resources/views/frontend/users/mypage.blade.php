@extends('frontend.layouts.app')

@section('title','Sa-blog')

@section('main')
<section class="info">
    <div class="container">
        <div class="row info-bdb">
            <div class="col-4">
                <div class="info-left">
                    <div class="info-left__img">
                        <img class="w-100 h-100" src="{{ asset('upload/'.$profile->image) }}" alt="">
                    </div>
                </div>
                <div class="info-left__title">
                    <span>{{ $user->name }}</span>
                </div>
                <div class="info-left__description">
                    <div>
                        <p>Lượt thích</p>
                        <span style="color: red">
                            <?php $save = 0 ?>
                            @foreach ($user->posts as $item)
                                <?php $save =$save+ count($item->usersSavedPost) ?>
                            @endforeach
                            {{ $save }}
                        </span>
                    </div>
                    <div>
                        <p>Bình luận</p>
                        <span>
                            <?php $comment = 0 ?>
                            @foreach ($user->posts as $item)
                                <?php $comment =$comment+ count($item->comments) ?>
                            @endforeach
                            {{ $comment }}
                        </span>
                    </div>
                    <div>
                        <p>Lượt xem</p>
                        <span>6868</span>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="info-center">
                    <div class="info-center__btn">
                        @if($can_follow == 1)
                        <form action="{{ route('users.follow',$profile->nickname) }}" method="POST">
                            @csrf
                            <button  class="btn btn-outline-info"><i class="fas fa-rss"></i> Follow</button>
                        </form>
                        @elseif($can_follow == 2)
                        <form action="{{ route('users.follow',$profile->nickname) }}" method="POST">
                            @csrf
                            <button  class="btn btn-outline-info"><i class="fas fa-rss"></i> Unfollow</button>
                        </form>
                        @endif
                    </div>
                    <div class="info-center__followed">
                        <p>{{ count($user->followers) }} người theo dõi <span>{{ $user->name }}</span></p>
                        <div>
                            @foreach ($user->followers as $item)
                            <a href="{{ route('users.mypage',$item->profile->nickname) }}">
                                <img src="{{ asset('upload/'.$item->profile->image) }}" alt="">
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="info-center__following">
                        <p>{{ count($user->follows) }} người được <span>{{ $user->name }}</span> theo dõi</p>
                        <div>
                            @foreach ($user->follows as $item)
                            <a href="{{ route('users.mypage',$item->profile->nickname) }}">
                                <img src="{{ asset('upload/'.$item->profile->image) }}" alt="">
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="info-center__tag">
                        <p>Chủ đề</p>
                        <div>
                            <a href="#">chu de 1</a>
                            <a href="#">chu de 1</a>
                            <a href="#">chu de 1</a>
                            <a href="#">chu de 1</a>
                            <a href="#">chu de 1</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="info-right">
                    <div id="myChart">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="post-me">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                @foreach ($user->posts as $item)
                <div class="posts-item">
                    <div class="row">
                        <div class="col-2">
                            <div class="posts-item__img">
                                <a href="{{ route('users.mypage',$profile->nickname) }}">
                                    <img class="w-100 h-100" src="{{ asset('upload/'.$profile->image) }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-8">
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
                                        <a href="{{ route('users.mypage',$profile->nickname) }}">{{ $user->name }}</a>

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
                        <div class="col-md-1">
                            <div class="drafts-item__options" style="text-align: right">
                                <a href="{{ route('posts.edit',$item->slug) }}"><i class="fas fa-edit"></i></a>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="drafts-item__options">
                                <form action="{{ route('posts.destroy',$item->slug) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa bài viết này ?');"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

@endsection

@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:700">
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
@endsection
