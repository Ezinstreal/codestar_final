<?php $i=0 ?>

<form action="">
    @csrf
    <input type="hidden" name="post_id" id="post_id" value="{{ $comments->first()->post_id }}">
</form>
@foreach ($comments as $item)

<div class="show-comment-item">
    <div class="row g-0">
        <div class="col-1 offset-1">
            <div class="show-comment-item__img">
                <a href="{{ route('users.mypage',$item->users->first()->profile->nickname) }}">
                    <img src="{{ asset('upload/'.$item->users->first()->profile->image) }}" alt="">
                </a>
            </div>
        </div>
        <div class="col-9">
            <div class="show-comment-item__title">
                <a href="{{ route('users.mypage',$item->users->first()->profile->nickname) }}">
                    <span>{{ $item->users->first()->name }}</span>
                </a>
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
            <div class="show-comment-item__description">
                {{ $item->content }}
            </div>
            <div class="show-comment-item__like">
                @if($item->usersLiked->where('id',Auth::user()->id)->first())
                <button type="button" id="btnLike{{ $i }}" data-cmt="{{ $item->id }}" data-value="0">Unlike </button>
                <span id="iconLike{{ $i }}"><i class="fas fa-thumbs-up" style="color: #1e8c97"></i></span> <span id="countLike{{ $i }}" data-value="{{ count($item->usersLiked) }}"> {{ count($item->usersLiked) }}</span>
                @else
                <button type="button" id="btnLike{{ $i }}" data-cmt="{{ $item->id }}" data-value="1">Like </button>
                <span id="iconLike{{ $i }}"><i class="far fa-thumbs-up"></i></span> <span id="countLike{{ $i }}" data-value="{{ count($item->usersLiked) }}"> {{ count($item->usersLiked) }}</span>
                @endif
            </div>
        </div>
    </div>
</div>
<?php $i=$i+1 ?>
@endforeach
<script>
    $(document).ready(function(){
        var post_id = $('#post_id').val();
        var _token = $('input[name="_token"]').val();
        <?php $maxP = count($comments);
        for($i = 0; $i<$maxP ; $i++){ ?>
            $('#btnLike{{ $i }}').click(function(){
            var valueLike = $('#btnLike{{ $i }}').data('cmt');

            $.ajax({
                url:"{{ url('posts/likecomment') }}",
                method:"POST",
                data:{post_id:post_id, _token:_token, cmt_id:valueLike},
                success:function(data){
                    var countLike = $('#countLike{{ $i }}').data('value');
                    var btnValue = $('#btnLike{{ $i }}').data('value');
                    if(btnValue == 1){
                        $('#btnLike{{ $i }}').text('Unlike');
                        $('#btnLike{{ $i }}').data('value',0);
                        $('#iconLike{{ $i }}').html('<i class="fas fa-thumbs-up" style="color: #1e8c97"></i>');
                        $('#countLike{{ $i }}').text(countLike+1);
                        $('#countLike{{ $i }}').data('value',countLike+1);
                    }else{
                        $('#btnLike{{ $i }}').text('Like');
                        $('#btnLike{{ $i }}').data('value',1);
                        $('#iconLike{{ $i }}').html('<i class="far fa-thumbs-up"></i>');
                        $('#countLike{{ $i }}').text(countLike-1);
                        $('#countLike{{ $i }}').data('value',countLike-1);
                    }
                }
            });
        });
    <?php } ?>
    });
</script>

