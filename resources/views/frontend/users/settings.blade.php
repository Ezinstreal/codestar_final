@extends('frontend.layouts.app')

@section('title','')

@section('main')

<section class="settings">
    <div class="container">
        @if($user_me->email_verified_at == null)
        <div class="row">
            <div class="col-md-6 offset-md-5">
                <div class="alert alert-warning" role="alert">
                    Tài khoản của bạn chưa được xác thực.
                </div>
            </div>
            <div class="col-md-1">
                <form action="{{ route('users.verifyAgain') }}" method="POST">
                    @csrf
                    <button class="w-100 h-100 btn btn-warning">Xác thực</button>
                </form>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-3 offset-md-1 ">
                <div class="settings-nav nav flex-column nav-pills me-3" id="myTab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true"><i class="fas fa-user"></i> Tài khoản</a>
                    <a class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false"><i class="fas fa-lock"></i> Password</a>
                  </div>
            </div>
            <div class="col-md-6 offset-md-1">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <form class="settings-profile" id="form1" runat="server" method="POST" action="{{ route('users.settings.profile') }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            @include('errors.note')
                            <p>Ảnh đại diện</p>
                            <div class="settings-div-img mb-4">
                                <div class="settings-div-img__img">
                                    <img class="w-100 h-100" id="blah" alt="your image" src="{{ asset('upload/'.$profile->image) }}"/>
                                    <input hidden name="image" value="{{ $profile->image }}" type="file" class="form-control" id="imgInp">

                                </div>
                                <label for="imgInp">Update</label>
                            </div>
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                            <div class="mb-4">
                                <label class="form-label">Email</label>
                                <input readonly type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Tên</label>
                                <input type="text" class="form-control @error('name') border border-danger @enderror" name="name" placeholder="Nhập tên của bạn" value="{{ $user->name }}">
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Ngày sinh</label>
                                <input name="birthday" value="{{ $profile->birthday }}" id="datemask" type="text" class="form-control" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Số điện thoại</label>
                                <input name="phone" value="{{ $profile->phone }}" type="text" class="form-control" placeholder="Nhập số điện thoại của bạn">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Địa chỉ</label>
                                <input name="address" value="{{ $profile->address }}" type="text" class="form-control" placeholder="Nhập địa chỉ của bạn">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Link cá nhân</label>
                                <input name="link" value="{{ $profile->link }}" type="text" class="form-control" placeholder="Nhập địa chỉ của bạn">
                            </div>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary"><i class="fas fa-home"></i> Bỏ qua</a>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                        <form class="settings-password" action="{{ route('users.settings.pw') }}" method="POST">
                            @method('PUT')
                            @csrf
                            @include('errors.note')
                            <div class="settings-password__success mb-4">
                                <i class="far fa-lightbulb"></i>
                                Password phải có ít nhất 8 ký tự
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Password hiện tại</label>
                                <input type="password" name="password" class="form-control @error('password') border border-danger @enderror" placeholder="Nhập password hiện tại">
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Password mới</label>
                                <input type="password" name="new_password" class="form-control @error('new_password') border border-danger @enderror" placeholder="Nhập password mới">
                                @error('new_password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Xác nhận password</label>
                                <input type="password" name="cf_password" class="form-control @error('cf_password') border border-danger @enderror" placeholder="Nhập password mới">
                                @error('cf_password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary"><i class="fas fa-home"></i> Bỏ qua</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('css')
<link rel="stylesheet" href="{{asset('css/settings.css')}}">
@endsection

@section('js')
<script>
    $(document).ready(function () {
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
        $('[data-mask]').inputmask();

    // store the currently selected tab in the hash value
    $("div.settings-nav > a").on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    console.log(hash);
    if(hash == '#v-pills-password'){
        $('#v-pills-profile-tab').removeClass('active');
        $('#v-pills-profile').removeClass('show');
        $('#v-pills-profile').removeClass('active');
        $(hash+'-tab').addClass('active');
        $(hash).addClass('show');
        $(hash).addClass('active');
    }
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });


</script>
@endsection
