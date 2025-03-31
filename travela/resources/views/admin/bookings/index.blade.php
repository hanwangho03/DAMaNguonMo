
@include('admin.blocks.adminheader')
        <div class="container-fluid mt-4">
            <h2 class="text-center text-primary">Quản lý Booking</h2>
       
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <body>
    <div class="container mt-5">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                 
                    <th>Khách hàng</th>
                    <th>Email</th>
                    <th>Ngày đặt</th>
                    <th>Người lớn</th>
                    <th>Trẻ em</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->bookingId }}</td>
                  
                    <td>{{ $booking->fullName }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->bookingDate }}</td>
                    <td>{{ $booking->numAdult }}</td>
                    <td>{{ $booking->numChild }}</td>
                    <td>{{ number_format($booking->totalPrice, 0, ',', '.') }} VND</td>
                    <td>
                        <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking->bookingId) }}">
                            @csrf
                            <select name="bookingStatus" class="form-select" onchange="this.form.submit()">
                                <option value="pending" {{ $booking->bookingStatus == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="confirmed" {{ $booking->bookingStatus == 'confirmed' ? 'selected' : '' }}>Xác nhận</option>
                                <option value="cancelled" {{ $booking->bookingStatus == 'cancelled' ? 'selected' : '' }}>Hủy</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.bookings.destroy', $booking->bookingId) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
    {{ $bookings->links() }}
</div>
</body>