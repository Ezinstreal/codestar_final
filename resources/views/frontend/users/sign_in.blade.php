@extends('frontend.layouts.app')

@section('title','Đăng nhập')

@section('main')

<section class="sign_in">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <form action="{{ route('users.postLogin') }}" method="POST">
                    @csrf
                    <div class="sign_in__title">
                        <span>SA-BLOG</span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') border border-danger @enderror" name="email" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}">
                        <label for="floatingInput">Email address</label>
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') border border-danger @enderror" id="floatingPassword" name="password" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <button class="w-100 mb-3 btn btn-success">Đăng nhập</button>
                    <div class="forget_pw">
                        <a href="{{ route('users.getForgot') }}">Quên password ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
@section('css')
<link rel="stylesheet" href="{{asset('css/sign_in.css')}}">
@endsection
