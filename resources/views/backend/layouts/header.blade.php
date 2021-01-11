<body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.index') }}" class="nav-link">Home</a>
          </li>

        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>

        <!-- Right navbar links -->

      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="{{ asset('images/safh.png') }}" alt="SAFH" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">Sa-Blog</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ asset('upload/'.$user_me->profile->image) }}" style="width: 50px;height:50px;border-radius:50%" alt="User Image">
            </div>
            <div class="info">
              <a  class="d-block"> {{ $user_me->name }} </a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

              <li class="nav-item has-treeview menu-open">
                <a class="nav-link active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Posts
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Danh sách</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.posts.create') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tạo mới</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview menu-open">
                <a class="nav-link active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Danh sách</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.user.create') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tạo mới</p>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="nav-item">
                  <form action="{{ route('admin.user.logout') }}" method="POST">
                    @csrf

                    <button class="nav-link" style="border: none;background-color:unset;color:white">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Logout
                    </p>
                    </button>
                </form>
              </li>
              {{-- <li class="nav-item">
                <a href="{{ route('admin.') }}" class="nav-link active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
              </li> --}}
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark"></h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>




