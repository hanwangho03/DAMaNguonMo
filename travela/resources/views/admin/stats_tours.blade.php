<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê Đặt Tour</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> 
</head>

<body>
    @include('admin.blocks.adminheader') 

    <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Thống kê Đặt Tour</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Quay lại</a>
    </div>
        @if($mostBookedTours->isNotEmpty())
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Tour</th>
                        <th>Tên Tour</th>
                        <th>Giá người lớn</th>
                        <th>Giá trẻ em</th>
                        <th>Ngày khởi hành</th>
                        <th>Số lượt đặt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mostBookedTours as $tour)
                        <tr>
                            <td>{{ $tour->tourId }}</td>
                            <td>{{ $tour->titlle ?? 'Chưa cập nhật' }}</td>
                            <td>{{ number_format($tour->priceAdult) }} VNĐ</td>
                            <td>{{ number_format($tour->priceChild) }} VNĐ</td>
                            <td>{{ $tour->startDate }}</td>
                            <td>{{ $tour->booking_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3 class="mt-5">Biểu đồ</h3>
            <canvas id="tourBookingChart" width="800" height="400"></canvas>
            <pre id="tourDataJson" style="display: none;">{!! json_encode($tourData, JSON_UNESCAPED_UNICODE) !!}</pre>
            <script src="{{ asset('clients/assets/js/tour_chart.js') }}"></script>
        @else
            <div class="alert alert-warning">Không có dữ liệu thống kê.</div>
        @endif
    </div>
</body>

</html>
