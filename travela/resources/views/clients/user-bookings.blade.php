@include('clients.blocks.header')
@include('clients.blocks.banner')

<div class="container mt-5">
    <h2 class="mb-4">Danh Sách Tour Đã Đặt</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($bookings->isEmpty())
        <p>Bạn chưa đặt tour nào.</p>
    @else
        <div class="table-responsive"> <!-- Tạo thanh cuộn ngang -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã Đơn</th>
                        <th>Tên Tour</th>
                        <th>Ngày Khởi Hành</th>
                        <th>Người Lớn</th>
                        <th>Trẻ Em</th>
                        <th>Tổng Giá</th>
                        <th>Ngày Đặt</th>
                        <th>Trạng Thái</th>
                        <th>Họ Tên</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                        <th>Địa Chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->bookingId }}</td>
                        <td>{{ $booking->titlle }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->startDate)->format('d-m-Y') }}</td>
                        <td>{{ $booking->numAdult }}</td>
                        <td>{{ $booking->numChild }}</td>
                        <td>{{ number_format($booking->totalPrice, 0, ',', '.') }} VNĐ</td>
                        <td>{{ \Carbon\Carbon::parse($booking->bookingDate)->format('d-m-Y') }}</td>
                        <td>{{ ucfirst($booking->bookingStatus) }}</td>
                        <td>{{ $booking->fullName }}</td>
                        <td>{{ $booking->email }}</td>
                        <td>{{ $booking->phoneNumber }}</td>
                        <td>{{ $booking->address }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@include('clients.blocks.footer')
<style>.table-responsive {
    overflow-x: auto; /* Hiển thị thanh cuộn ngang khi bảng quá rộng */
}

.table {
    white-space: nowrap; /* Ngăn các ô xuống dòng không cần thiết */
}

.table th, .table td {
    text-align: center; /* Căn giữa nội dung */
    vertical-align: middle; /* Căn giữa theo chiều dọc */
    padding: 10px; /* Giãn cách ô */
    min-width: 120px; /* Đảm bảo mỗi cột có đủ độ rộng */
    word-wrap: break-word;
}
</style>