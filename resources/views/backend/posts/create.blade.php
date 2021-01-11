@extends('backend.layouts.app')

@section('title','Bai viet')

@section('main')

<form style="padding: 20px" action=" {{route('admin.posts.store')}} " method="POST">
    @csrf
    <table class="table">
        <thead class="thead-light">
            <th style="text-align: center">TẠO MỚI BÀI VIẾT</th>
        </thead>
    </table>
    <section class="create">

            <form id="form" action="{{ route('admin.posts.store') }}" method="POST">
                @csrf
                <label>Tiêu đề</label>
                @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                <input class="create-item__input @error('title') border border-danger @enderror" type="text" name="title" placeholder="Nhập tiêu đề" value="{{ old('title') }}">

                <div class="form-group">
                    @error('user')<span class="text-danger">{{ $message }}</span>@enderror
                    <label for="exampleFormControlSelect1">Tac gia</label>
                    <select class="form-control" name="user">
                        <option value="" disabled selected>Select your option</option>
                        @foreach ($author as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                <div class="form-group"><label for="">Options</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" required="required" id="inlineRadio1" value="1">
                        <label class="" for="inlineRadio1">Bai viet </label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" required="required" id="inlineRadio2" value="2">
                        <label class="" for="inlineRadio2"> Nhap</label>
                        </div>
                    <div class="form-check form-check-inline">
                        <input checked type="checkbox" name="status" value="1" class="form-check-input" id="status1">
                        <label class="form-check-label" for="status">Trạng thái</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="status2" value="1" class="form-check-input" id="status2">
                        <label class="form-check-label" for="status2">Nổi bật</label>
                    </div>
                </div>

                <label>Thêm tag cho bài viết</label>
                @error('tags')<span class="text-danger">{{ $message }}</span>@enderror
                <input id="form-tags-1"class="@error('tags') border border-danger @enderror" name="tags" type="text" value="Hanoi,100k,BiKipSongAo">

                <label>Mô tả về bài viết của bạn</label>
                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                <textarea class="create-item__input @error('description') border border-danger @enderror" rows="3" type="text" name="description">{{ old('description') }}</textarea>

                <label>Nội dung</label>
                @error('content')<span class="text-danger">{{ $message }}</span>@enderror
                <textarea id="summernote" name="content" class="@error('content') border border-danger @enderror">{{ old('content') }}</textarea>

                <div class="create-item__btn">

                    <button type="submit" class="btn btn-success" >Ok</button>
                </div>

            </form>

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
