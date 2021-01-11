<header>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- This makes the current user's id available in javascript -->
    @if(!auth()->guest())
        <script>
            window.Laravel.userId = <?php echo auth()->user()->id; ?>
        </script>
    @endif
    <div class="container">
        <div class="row g-0">
            <div class="col-5">
                <div class="header-left">
                    <div style="width: 80px">
                        <a class="header-left__a" href="{{ url('/') }}">SA-BLOG</a>
                    </div>
                    <div class="header-left-search">
                        <form action="">
                            <input type="text" placeholder="&#xF002; Tìm kiếm" style="font-family:Arial, FontAwesome">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="header-right">
                    @if(Auth::user())
                    <div class="header-right-item header-right-item-create dropdown">
                        <button class="dropdown-toggle" id="create_post" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-edit"></i> <span>Viết bài</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="create_post">
                            <li><a class="dropdown-item" href="{{ route('posts.create') }}"><i class="fas fa-file-alt"></i> Tạo mới</a></li>
                            <li><a class="dropdown-item" href="{{ route('posts.draft') }}"><i class="fas fa-file-signature"></i> Sửa bản nháp</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                    <div id="header_search" class="header-right-item">
                        <a href="#">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                    <div class="header-right-item" id="header_home">
                        <a href="{{ route('posts.index') }}">
                            <i class="fas fa-home"></i> <span>Trang chủ</span>
                        </a>
                    </div>
                    <div class="header-right-item">
                        <a href="{{ route('posts.getStorage') }}">
                            <i class="fas fa-bookmark"></i> <span>Đã lưu</span>
                        </a>
                    </div>
                    <div style="border: none" class="header-right-item header-right-item-bell dropdown">
                        <button class="" id="notifications bell" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" aria-expanded="true">
                            <i class="fas fa-bell"></i>
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="notificationsMenu" id="notificationsMenu">
                            <li><div class="row" style="padding: 0 10px;">
                                <div class="col-5">
                                    <div>
                                        Thông báo
                                    </div>
                                </div>
                                <div class="col-6 offset-1">
                                    <div id="btnAll" class="btnAll">
                                        Đánh dấu đã xem
                                    </div>
                                </div>
                            </div></li>
                            @if(count($notifications) >0)
                               <?php $noti = 0 ?>
                               <form action="#" method="POST">
                                @csrf

                               </form>
                                @foreach($notifications as $item)
                                    @if($item->type == 'App\Notifications\UserFollowed')
                                        <li><a id="notiValue{{ $noti }}" class="dropdown-item" data-value="{{ route('users.mypage',$item->data['nickname']) }}" data-noti="{{ $item->id }}">
                                            <div class="row g-0">
                                                <div class="col-3">
                                                    <img class="notifications-img" src="{{ asset('upload/'.$item->data['image']) }}" alt="">
                                                </div>
                                                <div class="col-9">
                                                    <strong>{{ $item->data['name'] }} </strong> đã follow bạn.

                                                    <div class="notiTime" id="notiTime{{ $noti }}"  style="font-size: 12.5px;{{($item->read_at == null)? 'color: #1e8c97': ''}}">
                                                        @if($item->created_at->diff(now())->y>0)
                                                        cách đây {{ $item->created_at->diff(now())->y }} năm trước.
                                                        @elseif($item->created_at->diff(now())->m>0)
                                                        cách đây {{ $item->created_at->diff(now())->m }} tháng trước.
                                                        @elseif($item->created_at->diff(now())->d>0)
                                                        cách đây {{ $item->created_at->diff(now())->d }} ngày trước.
                                                        @elseif($item->created_at->diff(now())->h>0)
                                                        cách đây {{ $item->created_at->diff(now())->h }} giờ trước.
                                                        @elseif($item->created_at->diff(now())->i>0)
                                                        cách đây {{ $item->created_at->diff(now())->i }} phút trước.
                                                        @else
                                                        vừa xong.
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </a></li>

                                    @endif
                                    @if($item->type == 'App\Notifications\PostNew')
                                        <li><a id="notiValue{{ $noti }}" class="dropdown-item" data-value="{{ route('posts.show',$item->data['post_slug']) }}" data-noti="{{ $item->id }}">
                                            <div class="row g-0">
                                                <div class="col-3">
                                                    <img class="notifications-img" src="{{ asset('upload/'.$item->data['image']) }}" alt="">
                                                </div>
                                                <div class="col-9">
                                                    <strong>{{ $item->data['user_name'] }} </strong> đã tạo bài viết mới.

                                                    <div class="notiTime" id="notiTime{{ $noti }}" style="font-size: 12.5px;{{($item->read_at == null)? 'color: #1e8c97': ''}}">
                                                        @if($item->created_at->diff(now())->y>0)
                                                        cách đây {{ $item->created_at->diff(now())->y }} năm trước.
                                                        @elseif($item->created_at->diff(now())->m>0)
                                                        cách đây {{ $item->created_at->diff(now())->m }} tháng trước.
                                                        @elseif($item->created_at->diff(now())->d>0)
                                                        cách đây {{ $item->created_at->diff(now())->d }} ngày trước.
                                                        @elseif($item->created_at->diff(now())->h>0)
                                                        cách đây {{ $item->created_at->diff(now())->h }} giờ trước.
                                                        @elseif($item->created_at->diff(now())->i>0)
                                                        cách đây {{ $item->created_at->diff(now())->i }} phút trước.
                                                        @else
                                                        vừa xong.
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>



                                        </a></li>
                                    @endif
                                    <?php $noti = $noti+1 ?>
                                @endforeach
                            @else
                            <li><a class="dropdown-item" href="#">Chưa có thông báo nào :)</a></li>
                            @endif

                    </div>
                    <div class="header-right-item-user dropdown">
                        <button class="dropdown-toggle" id="dd_user" data-bs-toggle="dropdown" aria-expanded="false">
                           <img src="{{ asset('upload/'.$user_me->profile->image) }}" alt="">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dd_user">
                            <li><a class="dropdown-item" href="{{ route('users.mypage',$user_me->profile->nickname) }}"><i class="fas fa-user"></i> Trang cá nhân</a></li>
                            <li><a class="dropdown-item" href="{{ route('users.settings.index') }}"><i class="fas fa-cog"></i> Cài đặt</a></li>
                            <li><a class="dropdown-item" href="{{ route('users.logout') }}"><i class="fas fa-sign-in-alt"></i> Đăng xuất</a></li>
                        </ul>
                    </div>
                    @else
                    @if (!empty($headerUrl))
                        <a class="header-right__a" href="{{ url('users/sign_up') }}"><i class="fas fa-user"></i> Đăng ký</a>
                        @else
                        <a class="header-right__a" href="{{ url('users/sign_in') }}"><i class="fas fa-sign-in-alt"></i>  Đăng nhập</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

