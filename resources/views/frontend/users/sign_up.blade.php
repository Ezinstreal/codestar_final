@extends('frontend.layouts.app')

@section('title','Đăng ký')

@section('main')

<section class="sign_in">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <form action="{{ route('users.postRegister') }}" method="POST">
                    @csrf
                    <div class="sign_in__title">
                        <span>SA-BLOG</span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') border border-danger @enderror" id="floatingInput" placeholder="Username" name="name" value="{{ old('name') }}">
                        <label for="floatingInput">User name</label>
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') border border-danger @enderror" id="floatingInput" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                        <label for="floatingInput">Email address</label>
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') border border-danger @enderror" id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">Password</label>
                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('cf_password') border border-danger @enderror" id="floatingCfPassword" placeholder="Confirm Password" name="cf_password">
                        <label for="floatingCfPassword">Confirm Password</label>
                        @error('cf_password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-check mb-3">
                        <input required class="form-check-input" type="checkbox" value="1" id="rule" name="rule">
                        <label class="form-check-label" for="rule">
                            Đồng ý với <a class="sign_in-rule" href="#">điều khoản sử dụng</a>
                        </label>
                      </div>
                    <button class="w-100 mb-3 btn btn-success">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
@section('css')
<link rel="stylesheet" href="{{asset('css/sign_in.css')}}">
@endsection
