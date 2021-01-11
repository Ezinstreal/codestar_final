@extends('frontend.layouts.app')

@section('title','Sửa bài viết')


@section('main')
<section class="create">
    <div class="container">
        <form id="form" action="{{ route('posts.update',$post->slug) }}" method="POST">
            @csrf
            @method('PUT')
            <h2 class="text-center create__title">Hãy chia sẻ câu chuyện của bạn, trải nghiệm của bạn.</h2>

            <label>Tiêu đề</label>
            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
            <input class="create-item__input @error('title') border border-danger @enderror" type="text" name="title" placeholder="Nhập tiêu đề" value="{{ $post->title }}">

            {{-- <label>Gắn địa điểm</label>
            <select class="js-example-theme" name="place" style="width: 100%">
                <option value="AL">Alabama</option>
                  ...
                <option value="WY">Wyoming</option>
              </select> --}}

            <label>Thêm tag cho bài viết</label>
            @error('tags')<span class="text-danger">{{ $message }}</span>@enderror
            <input id="form-tags-1" class="@error('tags') border border-danger @enderror" name="tags" type="text" value="@foreach ($post->tags as $item)
                {{ $item->name }},
            @endforeach">

            <label>Mô tả về bài viết của bạn</label>
            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
            <textarea class="create-item__input @error('description') border border-danger @enderror" rows="3" type="text" name="description">{{ $post->description }}</textarea>

            <label>Nội dung</label>
            @error('content')<span class="text-danger">{{ $message }}</span>@enderror
            <textarea id="summernote" name="content" class="@error('content') border border-danger @enderror">
                {!! $post->content !!}
            </textarea>

            <div class="create-item__btn">
                @if($post->type == 1)
                <button type="submit" class="btn btn-success" name="create_btn" value="save_btn">Lưu thay đổi</button>
                <a href="{{ route('posts.draft') }}" type="submit" class="btn btn-secondary">Kho nháp</a>
                @else
                <button type="submit" class="btn btn-secondary" name="create_btn" value="save_btn">Lưu thay đổi</button>
                <button type="submit" class="btn btn-success" name="create_btn" value="post_btn">Đăng bài</button>
                @endif
            </div>
        </form>
    </div>
</section>
@endsection
@section('css')
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"; rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/input_tags.css') }}">
<link rel="stylesheet" href="{{ asset('css/create.css') }}">

@endsection

@section('js')
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js";></script>
<script src="{{ asset('js/input_tags.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write here...',
            height: 600,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', [ 'picture','link']],
                ['table', ['table']],
            ],
        });
        $ (".js-example-theme"). select2 ();
    });
</script>

@endsection
