@extends('frontend.layouts.app')

@section('title','Sa-blog')

@section('main')

<section class="posts">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="text-center" style="padding: 100px 0">
                    <h2>Danh sách bản nháp</h2>
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
                                <div class="col-md-1">
                                    <div class="drafts-item__options">
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endsection
@section('js')
<script src="{{asset('js/jquery.lockfixed.min.js')}}"></script>

@endsection
