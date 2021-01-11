@extends('backend.layouts.app')

@section('title','Admin')
@section('main')

<div style="padding: 20px">
    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf
        <div class="sign_in__title">

        </div>
        <div class="form-floating mb-3">
            <label for="floatingInput">User name</label>
            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
            <input type="text" class="form-control @error('name') border border-danger @enderror" id="floatingInput" placeholder="Username" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-floating mb-3">
            <label for="floatingInput">Email address</label>
            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
            <input type="email" class="form-control @error('email') border border-danger @enderror" id="floatingInput" placeholder="name@example.com" name="email" value="{{ old('email') }}">

        </div>
        <div class="form-floating mb-3">
            <label for="floatingPassword">Password</label>
            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
            <input type="password" class="form-control @error('password') border border-danger @enderror" id="floatingPassword" placeholder="Password" name="password">

        </div>
        <div class="form-floating mb-3">
            <label for="floatingCfPassword">Confirm Password</label>
            @error('cf_password')<span class="text-danger">{{ $message }}</span>@enderror
            <input type="password" class="form-control @error('cf_password') border border-danger @enderror" id="floatingCfPassword" placeholder="Confirm Password" name="cf_password">

        </div>
        <label for="">Rule</label>
        @error('rule')<span class="text-danger">{{ $message }}</span>@enderror
        @can('role-admin')
        <div class="form-check form-check-inline">
            <input required="required" class="form-check-input" type="radio" name="role" id="inlineRadio1" value="1">
            <label class="form-check-label" for="inlineRadio1">admin</label>
        </div>
        @endcan
        <div class="form-check form-check-inline">
            <input required="required" class="form-check-input" type="radio" name="role" id="inlineRadio2" value="2">
            <label class="form-check-label" for="inlineRadio2">author</label>
        </div>
        <div class="form-check form-check-inline">
            <input required="required" class="form-check-input" type="radio" name="role" id="inlineRadio2" value="3">
            <label class="form-check-label" for="inlineRadio2">user</label>
        </div>
        <div class="mb-4">
            <label class="form-label">Birthday</label>
            <input name="birthday" value="{{ old('birthday') }}" id="datemask" type="text" class="form-control" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
        </div>
        <div class="form-floating mb-3">
            <label for="floatingInput">Phone</label>
            <input type="text" class="form-control" id="floatingInput" placeholder="Phone" name="phone" value="{{ old('phone') }}">
        </div>
        <div class="form-floating mb-3">
            <label for="floatingInput">Address</label>
            <input type="text" class="form-control" id="floatingInput" placeholder="Address" name="address" value="{{ old('address') }}">
        </div>
        <div class="form-floating mb-3">
            <label for="floatingInput">Link</label>
            <input type="text" class="form-control" id="floatingInput" placeholder="Link" name="link" value="{{ old('link') }}">
        </div>
        <div class="form-check mb-3">
            {{-- <input required class="form-check-input" type="checkbox" value="1" id="rule" name="rule">
            <label class="form-check-label" for="rule">
                Đồng ý với <a class="sign_in-rule" href="#">điều khoản sử dụng</a>
            </label> --}}
          </div>
        <button class="mb-3 btn btn-success">Đăng ký</button>
    </form>
</div>

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
</script>
@endsection
