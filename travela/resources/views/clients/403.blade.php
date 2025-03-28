@include('clients.blocks.header')
@include('clients.blocks.banner_home')


<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="text-center">
        <h1 class="text-danger">403</h1>
        <h2>Bạn không có quyền truy cập trang này!</h2>
        <p>Vui lòng quay lại <a href="{{ route('home') }}">trang chủ</a> hoặc liên hệ quản trị viên.</p>
    </div>
</body>





@include('clients.blocks.footer')  