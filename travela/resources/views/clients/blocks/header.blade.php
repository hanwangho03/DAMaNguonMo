<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Ravelo - Travel & Tour Booking HTML Template</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="{{ asset('clients/assets/images/logos/favicon.png') }}" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Flaticon -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/flaticon.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/fontawesome-5.14.0.min.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/bootstrap.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/magnific-popup.min.css') }}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/nice-select.min.css') }}">
    <!-- Animate -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/aos.css') }}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/slick.min.css') }}">
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/style.css') }}">
</head>
<body>
    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader"><div class="custom-loader"></div></div>

        <!-- Main Header -->
        <header class="main-header header-one white-menu menu-absolute">
    <!-- Header-Upper -->
    <div class="header-upper py-30 rpy-0">
        <div class="container-fluid clearfix">
            <div class="header-inner rel d-flex align-items-center">
                <div class="logo-outer">
                    <div class="logo">
                        <a href="{{ url('/home') }}">
                            <img src="{{ asset('clients/assets/images/logos/logo.png') }}" alt="Logo" title="Logo">
                        </a>
                    </div>
                </div>

                <div class="nav-outer mx-lg-auto ps-xxl-5 clearfix">
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-lg">
                        <div class="navbar-header">
                            <div class="mobile-logo">
                                <a href="{{ url('/home') }}">
                                    <img src="{{ asset('clients/assets/images/logos/logo.png') }}" alt="Logo" title="Logo">
                                </a>
                            </div>
                            <!-- Toggle Button -->
                            <button type="button" class="navbar-toggle" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <li class="dropdown current"><a href="#">Home</a>
                                    <ul>
                                        <li><a href="{{ url('/') }}">Travel Agency</a></li>
                                        <li><a href="{{ url('/home') }}">City Tour</a></li>
                                        <li><a href="{{ url('/home') }}">Tour Package</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ url('/about') }}">About</a></li>
                                <li class="dropdown"><a href="{{ url('/tours') }}">Tours</a>
                                    <ul>
                                        <li><a href="{{ url('/tours') }}">Tour List</a></li>
                                        <li><a href="#">Tour Grid</a></li>
                                        <li><a href="#">Tour Sidebar</a></li>
                                        <li><a href="{{ url('/tour-details') }}">Tour Details</a></li>
                                        <li><a href="{{ url('/tour-guides') }}">Tour Guide</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Destinations</a>
                                    <ul>
                                        <li><a href="{{ url('/destination') }}">Destination</a></li>
                                    </ul>
                                </li>
                                <li ><a href="{{ url('/user-bookings') }}">Booked</a></li>
                                    
                                <li class="dropdown"><a href="#">Blog</a>
                                    <ul>
                                        <li><a href="#">Blog List</a></li>
                                        <li><a href="#">Blog Details</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->
                </div>

                <!-- Nav Search -->
                <div class="nav-search">
                    <button class="far fa-search"></button>
                    <form action="#" class="hide">
                        <input type="text" placeholder="Search" class="searchbox" required="">
                        <button type="submit" class="searchbutton far fa-search"></button>
                    </form>
                </div>

                <!-- Menu Button -->
                <div class="menu-btns py-10 d-flex align-items-center">
                    <a href="#" class="theme-btn style-two bgc-secondary">
                        <span data-hover="Book Now">Book Now</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>

                    @if(session()->has('username'))
    <!-- Hiển thị avatar và tên người dùng với liên kết đến trang thông tin -->
    <div class="user-menu ms-3 d-flex align-items-center">
        <a href="{{ route('user.profile', session('userId')) }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('clients/assets/images/team/avatauser.jpg') }}" 
                 alt="User Avatar" 
                 class="rounded-circle" 
                 width="40" 
                 height="40">
            <span class="ms-2 fw-bold text-white">{{ session('username') }}</span>
        </a>

        <!-- Nút Đăng xuất -->
        <form action="{{ route('logout') }}" method="POST" class="ms-3">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>
@else
    <!-- Nút Login nếu chưa đăng nhập -->
    <a href="{{ url('/login') }}" class="login-btn ms-3">
        <i class="fas fa-user"></i> Login
    </a>
@endif

                    <!-- Menu Sidebar -->
                    <div class="menu-sidebar ms-3">
                        <button class="bg-transparent">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Upper -->
</header>
