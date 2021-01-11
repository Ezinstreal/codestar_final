@extends('frontend.layouts.app')

@section('title','Quên mật khẩu')

@section('main')

<section class="sign_in">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <form action="{{ route('users.postForgot') }}" method="POST">
                    @csrf
                    <div class="sign_in__title">
                        <span>SA-BLOG</span>
                    </div>
                    @include('errors.note')
                    <div class="form-floating mb-3">
                        <input required type="email" class="form-control @error('email') border border-danger @enderror" name="email" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}">
                        <label for="floatingInput">Email address</label>
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <button class="w-100 mb-3 btn btn-success">Gửi mã xác thực</button>

                </form>
            </div>
        </div>
    </div>
</section>

@endsection
@section('css')
<link rel="stylesheet" href="{{asset('css/sign_in.css')}}">
@endsection
