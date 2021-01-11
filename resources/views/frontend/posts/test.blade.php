@extends('frontend.layouts.app')

@section('title','Test')


@section('main')
<section class="create">
    {{-- <div class="container">
        <form id="form">
            <h2 class="text-center create__title">Hãy chia sẻ câu chuyện của bạn, trải nghiệm của bạn.</h2>
            <label for="">Tiêu đề</label>
            <input class="create-item__input" type="text" placeholder="Nhập tiêu đề">
            <label>Thêm tag cho bài viết</label>
            <input id="form-tags-1" name="tags-1" type="text" value="jQuery,Script,Net">
            <label >Nôi dung</label>
            <textarea id="summernote" name="editordata"></textarea>

        </form>
    </div> --}}
    <select class="js-example-basic-single" name="state">
        <option value="AL">Alabama</option>
          ...
        <option value="WY">Wyoming</option>
      </select>
      <?php $i=0 ?>
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
                  {{-- <div class="show-comment-item__like">
                      <form action="{{ route('posts.likecomment',$item->id) }}" method="POST">
                          @csrf
                          <button><i class="far fa-thumbs-up"></i></button>
                          {{ count($item->usersLiked) }}
                      </form>
                  </div> --}}
                  <div class="show-comment-item__like">
                      @if($item->usersLiked->where('id',Auth::user()->id)->first())
                      <button type="button" id="btnLike{{ $i }}" data-cmt="{{ $item->id }}" data-value="0">Unlike </button>
                      <i class="fas fa-thumbs-up"></i> <span id="countLike{{ $i }}" data-value="{{ count($item->usersLiked) }}"> {{ count($item->usersLiked) }}</span>
                      @else
                      <button type="button" id="btnLike{{ $i }}" data-cmt="{{ $item->id }}" data-value="1">Like </button>
                      <i class="far fa-thumbs-up"></i> <span id="countLike{{ $i }}" data-value="{{ count($item->usersLiked) }}"> {{ count($item->usersLiked) }}</span>
                      @endif
                  </div>
              </div>
          </div>
      </div>
      {{ $i }}
      <?php $i=$i+1 ?>
      @endforeach


</section>
@endsection
@section('css')
{{-- <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/input_tags.css') }}">
<link rel="stylesheet" href="{{ asset('css/create.css') }}"> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"; rel="stylesheet" />
@endsection

@section('js')
<script>
    $(document).ready(function(){
        <?php $maxP = count($comments);
        for($i = 0; $i<$maxP ; $i++){ ?>
            $('#btnLike{{ $i }}').click(function(){
            var valueLike = $('#btnLike{{ $i }}').data('cmt');
            alert(valueLike)
            // $.ajax({
            //     url:"{{ url('posts/comment-like') }}",
            //     method:"POST",
            //     data:{post_id:post_id, _token:_token, cmt_id:valueLike},
            //     success:function(data){
            //         var countLike = $('#countLike{{ $i }}').data('value');
            //         var btnValue = $('#btnLike{{ $i }}').data('value');
            //         if(btnValue == 1){
            //             $('#btnLike{{ $i }}').text('Unlike');
            //             $('#btnLike{{ $i }}').data('value',0);
            //             $('#countLike{{ $i }}').text(countLike+1);
            //             $('#countLike{{ $i }}').data('value',countLike+1);
            //         }else{
            //             $('#btnLike{{ $i }}').text('Like');
            //             $('#btnLike{{ $i }}').data('value',1);
            //             $('#countLike{{ $i }}').text(countLike-1);
            //             $('#countLike{{ $i }}').data('value',countLike-1);
            //         }
            //     }
            // });
        });
    <?php } ?>
    });
</script>
{{-- <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{ asset('js/input_tags.js') }}"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js";></script>
<script>
    // $(document).ready(function() {
    //     $('#summernote').summernote({
    //         placeholder: 'Write here...',
    //         height: 600,
    //         toolbar: [
    //             ['style', ['bold', 'italic', 'underline', 'clear']],
    //             ['fontsize', ['fontsize']],
    //             ['fontname', ['fontname']],
    //             ['color', ['color']],
    //             ['para', ['ul', 'ol', 'paragraph']],
    //             ['height', ['height']],
    //             ['insert', [ 'picture','link']],
    //             ['table', ['table']],
    //         ],
    //     });
    // });
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
  </script>

@endsection
