@include('clients.blocks.header')
@include('clients.blocks.banner')

<section class="container" style="margin: 50px auto; max-width: 800px;">
    <div class="success-container card">
        <div class="success-icon">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 12l2 2 4-4m-6 6h6m-3-12a9 9 0 110 18 9 9 0 010-18z" stroke="#28a745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h2 class="success-header">Thanh Toán Thành Công!</h2>
        
        <!-- Hiển thị flash message nếu có -->
        @if (session('success'))
            <p class="success-message alert alert-success">{{ session('success') }}</p>
        @elseif (session('error'))
            <p class="success-message alert alert-danger">{{ session('error') }}</p>
        @else
            <p class="success-message">Cảm ơn bạn đã đặt tour tại Travela. Dưới đây là thông tin chi tiết về đơn hàng của bạn.</p>
        @endif

        <div class="booking-details">
            <h3 class="details-header">Thông Tin Đơn Hàng</h3>
            <div class="details-content">
                <p><strong>Mã đơn hàng:</strong> {{ $booking->bookingId }}</p>
                <p><strong>Tour:</strong> {{ $tour->titlle ?? $tour->title }}</p> <!-- Sửa titlle thành title, thêm fallback -->
                <p><strong>Ngày khởi hành:</strong> {{ $tour->startDate }}</p>
                <p><strong>Ngày kết thúc:</strong> {{ $tour->endDate }}</p>
                <p><strong>Số lượng người lớn:</strong> {{ $booking->numAdult }}</p>
                <p><strong>Số lượng trẻ em:</strong> {{ $booking->numChild }}</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($booking->totalPrice, 0, ',', '.') }} VNĐ</p>
                <p><strong>Trạng thái:</strong> {{ $booking->bookingStatus }}</p>
                <p><strong>Họ và tên:</strong> {{ $booking->fullName }}</p>
                <p><strong>Email:</strong> {{ $booking->email }}</p>
                <p><strong>Số điện thoại:</strong> {{ $booking->phoneNumber }}</p>
                <p><strong>Địa chỉ:</strong> {{ $booking->address }}</p>
            </div>
        </div>

        <div class="button-group">
            <a href="{{ route('home') }}" class="success-btn btn-home">Về Trang Chủ</a>
            <a href="{{ route('tour-detail', ['id' => $tour->tourId]) }}" class="success-btn btn-details">Xem Chi Tiết Tour</a>
            <a href="{{ route('invoice-detail', ['invoiceId' => $invoice->invoiceId]) }}" class="success-btn btn-invoice">Xem Hóa Đơn</a>
        </div>
    </div>
</section>

@include('clients.blocks.footer')

<style>
.success-container {
    padding: 30px;
    text-align: center;
}

.success-icon {
    margin-bottom: 20px;
}

.success-header {
    font-size: 28px;
    color: #28a745;
    margin-bottom: 15px;
}

.success-message {
    font-size: 16px;
    color: #555;
    margin-bottom: 30px;
}

.booking-details {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    text-align: left;
    margin-bottom: 30px;
}

.details-header {
    font-size: 20px;
    color: #333;
    margin-bottom: 15px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 8px;
}

.details-content p {
    font-size: 15px;
    color: #666;
    margin: 10px 0;
}

.details-content strong {
    color: #333;
    font-weight: 600;
}

.button-group {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.success-btn {
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    text-decoration: none;
    color: white;
    transition: background 0.3s;
    display: inline-block;
}

.btn-home {
    background: #007bff;
}

.btn-home:hover {
    background: #0056b3;
}

.btn-details {
    background: #28a745;
}

.btn-details:hover {
    background: #218838;
}

.btn-invoice {
    background: #ffc107; /* Màu vàng cho nút hóa đơn */
}

.btn-invoice:hover {
    background: #e0a800;
}

@media (max-width: 768px) {
    .button-group {
        flex-direction: column;
        gap: 10px;
    }

    .success-btn {
        width: 100%;
    }
}
</style>