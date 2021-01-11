@extends('frontend.layouts.app')

@section('title','Sa-blog')

@section('main')

<section class="show-p">
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div class="show__title">
                    <span>{{ $data->title }}</span>
                </div>
                <div class="show__tags">
                    @foreach ($data->tags as $item)
                        <a href="#">{{ $item->name }}</a>
                    @endforeach
                </div>
                <div class="show__description">
                    <a href="{{ route('users.mypage',$data->users->first()->profile->nickname) }}">
                        <img src="{{ asset('upload/'.$data->users->first()->profile->image) }}" alt="">
                        <span>{{ $data->users->first()->name }}</span>

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
                        viết {{ $item->created_at->diff(now())->s }} giây trước.
                        @endif
                    </a>
                </div>
                <div class="show__content">
                    {!! $data->content !!}
                </div>
                <div class="show-comment">
                    <div class="show-comment__title">
                        Bình luận
                    </div>
                    <div id="commentShow" class="show-comment-item__div">
                        <input type="hidden" name="post_id" class="post_id" value="{{ $data->id }}">
                    </div>
                    <div class="show-create-comment show-comment-item">
                        <div class="row g-0">
                            <div class="col-9 offset-2">
                                <div style="display: none" id="alertComment" class="alert alert-success text-center"></div>
                            </div>
                            <div class="col-1 offset-1">
                                <div class="show-comment-item__img">
                                    <a href="{{ route('users.mypage',$user_me->profile->nickname) }}">
                                        <img src="{{ asset('upload/'.$user_me->profile->image) }}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-9">
                               <div class="show-create-comment-input">
                                    <form action="#" >
                                        @csrf
                                        <input type="hidden" name="post_id" class="post_id" value="{{ $data->id }}">
                                        <input type="hidden" name="user_id" class="user_id" value="{{ $user_me->id }}">
                                        <textarea class="w-100 comment_content" type="text" name="comment" rows="3"></textarea>
                                        <button type="button" id="sendComment" class="btn btn-success">Gửi</button>
                                    </form>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div id="holdRight">
                    <div class="row g-0">
                        <div class="col-6">
                            <div class="show-right show-right-1">
                                <p id="countStorage" data-value="{{ count($data->usersSavedPost) }}">{{ count($data->usersSavedPost) }}</p>
                                <i class="fas fa-bookmark"></i> Lượt lưu
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="show-right">
                                <p id="countComment" data-value="{{ count($data->comments) }}">{{ count($data->comments) }}</p>
                                <i class="fas fa-comment"></i> Lượt bình luận
                            </div>
                        </div>
                    </div>
                    <div class="show-right-storage">
                        @if($user_me->savedPosts->where('slug',$data->slug)->first())
                        <button id="storageBtn" data-value="0" class="show-right-btn ">Bỏ lưu</button>
                        @else
                        <button id="storageBtn" data-value="1" class="show-right-btn ">Lưu</button>
                        @endif

                    </div>
                    <div class="show-right-user">
                        <div class="row g-0">
                            <div class="col-4 text-center">
                                <a href="{{ route('users.mypage',$data->users->first()->profile->nickname) }}">
                                    <img class="show-right-user__img" src="{{ asset('upload/'.$data->users->first()->profile->image) }}" alt="">
                                </a>
                            </div>
                            <div class="col-8">
                                <div class="show-right-user__name">
                                    <a href="{{ route('users.mypage',$data->users->first()->profile->nickname) }}">
                                        {{ $data->users->first()->name }}
                                    </a>
                                </div>
                                <div class="show-right-user__posts">
                                    <span>{{  count($data->users->first()->posts) }}</span> bài viết.
                                </div>
                                <div class="show-right-user__followers">
                                    <span>{{  count($data->users->first()->followers) }}</span> người follow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection
@section('js')
<script src="{{asset('js/jquery.lockfixed.min.js')}}"></script>
    <script>
         $(document).ready(function(){
            if (screen.width > 500) {
                $.lockfixed("#holdRight", {offset: {top: 20, bottom: 0} });
            }
            var post_id = $('.post_id').val();
            var _token = $('input[name="_token"]').val();
            load_comment();

            function load_comment(){
                $.ajax({
                    url:"{{ url('posts/loadcomment') }}",
                    method:"POST",
                    data:{post_id:post_id, _token:_token},
                    success:function(data){
                        $('#commentShow').html(data);
                    }
                });
            }
            $('#sendComment').click(function(){
                var content = $('.comment_content').val();
                $.ajax({
                    url:"{{ url('posts/sendcomment') }}",
                    method:"POST",
                    data:{post_id:post_id, _token:_token, content:content},
                    success:function(data){
                        var countComment = $('#countComment').data('value');
                        load_comment();
                        $('.comment_content').val('');
                        $('#countComment').text(countComment+1);
                        $('#countComment').data('value',countComment+1);
                        setTimeout(function(){
                            $('#alertComment').show();
                            $('#alertComment').text('Thêm bình luận thành công!');
                            $('#alertComment').fadeOut(2000);
                        },600);
                    }
                });
            });

            $('#storageBtn').click(function(){
                $.ajax({
                    url:"{{ url('posts/postStorage') }}",
                    method:"POST",
                    data:{post_id:post_id, _token:_token},
                    success:function(data){
                        var countStorage = $('#countStorage').data('value');
                        var btnValue = $('#storageBtn').data('value');

                        if(btnValue == 1){
                            $('#storageBtn').text('Bỏ lưu');
                            $('#storageBtn').data('value',0);
                            $('#countStorage').text(countStorage+1);
                            $('#countStorage').data('value',countStorage+1);
                        }else{
                            $('#storageBtn').text('Lưu');
                            $('#storageBtn').data('value',1);
                            $('#countStorage').text(countStorage-1);
                            $('#countStorage').data('value',countStorage-1);
                        }

                    }
                });
            });
        });
    </script>
@endsection
