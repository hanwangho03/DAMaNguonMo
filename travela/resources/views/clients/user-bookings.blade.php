@include('clients.blocks.header')
@include('clients.blocks.banner')

<div class="container mt-5 mb-5">
    <h2 class="mb-4 text-center text-primary fw-bold">Danh Sách Tour Đã Đặt</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($bookings->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i> Bạn chưa đặt tour nào.
        </div>
    @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
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
                            <td>
                                <span class="badge 
                                    {{ $booking->bookingStatus == 'confirmed' ? 'bg-success' : 
                                       ($booking->bookingStatus == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ ucfirst($booking->bookingStatus) }}
                                </span>
                            </td>
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

<!-- CSS tùy chỉnh -->
<style>
    .table-responsive {
        overflow-x: auto;
        border-radius: 10px;
        background: #fff;
    }

    .table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle;
        padding: 12px 15px;
        min-width: 120px;
        word-wrap: break-word;
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table tbody tr {
        transition: background-color 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .badge {
        font-size: 0.9em;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .text-primary {
        color: #007bff !important;
    }

    @media (max-width: 768px) {
        .table th, .table td {
            font-size: 0.9em;
            padding: 8px;
            min-width: 100px;
        }
    }
</style>