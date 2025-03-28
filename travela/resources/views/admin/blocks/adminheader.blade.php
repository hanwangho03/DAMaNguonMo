<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .navbar { background-color: #007bff; }
        .navbar-brand, .nav-link { color: white !important; }
        .nav-link:hover { color: #e9ecef !important; }
        .container-fluid { padding: 20px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Trang Quản Lý Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.tours') }}"><i class="fas fa-plane-departure me-1"></i> Quản lý Tour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}"><i class="fas fa-users me-1"></i> Quản lý User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.bookings') }}"><i class="fas fa-ticket-alt me-1"></i> Quản lý Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.comments') }}"><i class="fas fa-comments me-1"></i> Quản lý Comment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.stats_tours') }}"><i class="fas fa-star me-1"></i> Thống kê Đặt Tour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.stats.revenue') }}"><i class="fas fa-chart-line me-1"></i> Thống kê Doanh Thu</a>
                    </li>
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                    @csrf
                    <button type="submit" class="btn btn-danger">Đăng xuất</button>
                </form>
            </div>
        </div>
    </nav>