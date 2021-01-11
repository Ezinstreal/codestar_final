@extends('frontend.layouts.app')

@section('title','Sleep Away From Home')

@section('main')

<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1">
                <div class="home__title">
                    <span>Nơi chia sẻ về những hành trình <i class="fas fa-motorcycle"></i></span>
                </div>
                <div class="home__description">
                    Những chuyến bay,  những bãi biển,  cây cầu, còn đường ... <br>
                    hay thậm chí chỉ là những món ăn ngon, những tách cà phê đắng. <br>
                    Hãy tham gia để cùng chia sẻ với chúng tôi!
                    @if(Auth::user())
                    <a href="{{ route('posts.index') }}"> Khám phá ngay!!</a>
                    @else
                    <a href="{{ route('users.getRegister') }}">Đăng kí ngay!!</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="">

        </div>
    </div>
</section>

<section class="place" style="background-image: url('images/bgr1.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-12" >
                <div style="text-align: center">
                    <img class="w-75" src="{{ asset('images/text.png') }}" alt="">
                </div>
            </div>
            <div class="col-12">
                <div class="place__title">
                    <span>Đâu là điểm đến tiếp theo của bạn?</span>
                </div>
            </div>
        </div>
        <div class="row place-div">
            <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="place-item">
                    <a href="#">
                        <img class="w-100" src="{{ asset('images/hn.jpg') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="place-item">
                    <a href="#">
                        <img class="w-100" src="{{ asset('images/danang.jpg') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="place-item">
                    <a href="#">
                        <img class="w-100" src="{{ asset('images/h.jpg') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="place-item">
                    <a href="#">
                        <img class="w-100" src="{{ asset('images/dl.jpg') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="place-item">
                    <a href="#">
                        <img class="w-100" src="{{ asset('images/hcm.jpg') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="place-item">
                    <a href="#">
                        <img class="w-100" src="{{ asset('images/phuquoc.jpg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="topic">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="topic__title">
                    <span>Chúng tôi có mọi thông tin cần thiết</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="topic-item">
                    <div class="topic-item__title">
                        <a href="#"><i style="color: red" class="fas fa-map-marker-alt"></i> Địa Điểm Check-In</a>
                    </div>
                    <div class="topic-item__description">
                        <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Et repellat mollitia dolores reprehenderit voluptates autem
                            culpa esse aliquam molestiae nulla numquam, a ipsam qui odit?
                            Quis deleniti animi dicta magni.</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="topic-item">
                        <div class="topic-item__title">
                            <a href="#"><i style="color: orange" class="fas fa-utensils"></i> Địa điểm ăn uống</a>
                        </div>
                        <div class="topic-item__description">
                            <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                Et repellat mollitia dolores reprehenderit voluptates autem
                                culpa esse aliquam molestiae nulla numquam, a ipsam qui odit?
                                Quis deleniti animi dicta magni.</span>
                        </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="topic-item">
                    <div class="topic-item__title">
                        <a href="#"><i style="color:yellowgreen" class="fas fa-plane"></i> Du Lịch Biển Đảo</a>
                    </div>
                    <div class="topic-item__description">
                        <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Et repellat mollitia dolores reprehenderit voluptates autem
                            culpa esse aliquam molestiae nulla numquam, a ipsam qui odit?
                            Quis deleniti animi dicta magni.</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="topic-item">
                    <div class="topic-item__title">
                        <a href="#"><i style="color: darkred" class="fas fa-book"></i> Cẩm Nang Du Lịch</a>
                    </div>
                    <div class="topic-item__description">
                        <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Et repellat mollitia dolores reprehenderit voluptates autem
                            culpa esse aliquam molestiae nulla numquam, a ipsam qui odit?
                            Quis deleniti animi dicta magni.</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="topic-item">
                    <div class="topic-item__title">
                        <a href="#"><i style="color: darkblue" class="fas fa-camera-retro"></i> Bí Kíp Sống Ảo</a>
                    </div>
                    <div class="topic-item__description">
                        <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Et repellat mollitia dolores reprehenderit voluptates autem
                            culpa esse aliquam molestiae nulla numquam, a ipsam qui odit?
                            Quis deleniti animi dicta magni.</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="topic-item">
                    <div class="topic-item__title">
                        <a href="#"><i style="color: mediumvioletred" class="fas fa-laugh"></i> 100k Ăn Gì</a>
                    </div>
                    <div class="topic-item__description">
                        <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Et repellat mollitia dolores reprehenderit voluptates autem
                            culpa esse aliquam molestiae nulla numquam, a ipsam qui odit?
                            Quis deleniti animi dicta magni.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="topic__more">
                    <span>... và còn rất nhiều để khám phá ...</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="register_pls">
    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-md-3 register_pls__line">

            </div>
            <div class="col-sm-8 col-md-6">
                <div class="register_pls__title">
                    <span>Đăng ký dễ dàng và đơn giản</span>
                </div>
            </div>
            <div class="col-sm-2 col-md-3 register_pls__line">

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="register_pls__description">
                    Hãy tham gia để cùng chia sẻ với chúng tôi!
                    @if(Auth::user())
                    <a href="{{ route('posts.index') }}"> Khám phá ngay!!</a>
                    @else
                    <a href="{{ route('users.getRegister') }}">Đăng kí ngay!!</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection
