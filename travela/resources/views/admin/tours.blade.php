@include('admin.blocks.adminheader')
    <!-- Nội dung chính -->
    <div class="container-fluid mt-4">
        <h2 class="text-center text-primary">Quản lý Tour</h2>
    </div>


    <div class="row justify-content-center">
        <div class="d-flex gap-3 pb-3 px-3">
            <a href="{{ route('admin-create-tour') }}" class="btn btn-primary flex-grow-1 rounded-pill py-2 px-4">Create Tour</a>
        </div>
        @foreach ($tours as $tour)
            <div class="col-xxl-3 col-xl-4 col-md-6" style="margin-bottom: 30px">
                <div class="destination-item block_tours" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">

                    <!-- Bọc phần ảnh và nội dung trong một div khác để làm mờ -->
                    <div class="{{ !$tour->availability ? 'unavailable' : '' }}">
                        <div class="image">
                            <a>
                                <img src="{{ asset($tour->images[0] ?? 'clients/assets/images/default.jpg') }}" alt="Destination">
                            </a>
                        </div>

                        <div class="content">
                            <span class="location"><i class="fal fa-map-marker-alt"></i> {{ $tour->destination }}</span>
                            <h5 class="tour-title">
                                <a>{{ $tour->titlle }}</a>
                            </h5> 
                        </div>
                    </div>

                    <!-- Giữ nguyên nút không bị ảnh hưởng -->
                    <div class="d-flex gap-3 pb-3 px-3">
                        <a href="{{ route('admin-edit-tour', ['id' => $tour->tourId]) }}" 
                            class="btn btn-primary flex-grow-1 rounded-pill py-2 px-4">
                            Edit
                        </a>
                        <a href="{{ route('admin-delete-tour', ['id' => $tour->tourId]) }}" 
                            class="btn btn-danger flex-grow-1 rounded-pill py-2 px-4 {{ !$tour->availability ? 'disabled' : '' }}"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa tour này không?');">
                                Delete
                        </a>

                    </div>

                </div>
            </div>

        @endforeach
    </div>

    <nav class="d-flex justify-content-center mt-4">
        {{ $tours->links('pagination::bootstrap-5') }}
    </nav>


    <!-- Destinations Area end -->
    <style>
        /* CSS để đồng bộ kích thước các khung tour */
        .destination-item {
            height: 450px; /* Chiều cao cố định để đồng bộ tất cả khung */
            display: flex;
            flex-direction: column;
        }

        .destination-item .image {
            height: 200px; /* Chiều cao cố định cho hình ảnh */
            overflow: hidden;
        }

        .destination-item .image img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Đảm bảo hình ảnh không bị méo */
            transition: transform 0.3s ease;
        }

        .destination-item .image img:hover {
            transform: scale(1.05);
        }

        .destination-item .content {
            padding: 15px;
            flex-grow: 1; /* Chiếm không gian còn lại */
        }

        .destination-item .destination-footer {
            padding: 10px 15px;
        }
        .small.text-muted {
            display: none !important;
        }
        .unavailable {
            filter: grayscale(100%); /* Chuyển thành màu xám */
            opacity: 0.5; /* Làm mờ */
            pointer-events: none; /* Ngăn không cho bấm vào */
        }

        .unavailable img {
            opacity: 0.7; /* Làm mờ ảnh riêng */
        }

        .unavailable .content {
            opacity: 0.6; /* Làm mờ chữ */
        }


    </style>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/slick.min.css') }}">
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/style.css') }}">
</body>
</html>