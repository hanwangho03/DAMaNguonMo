@include('clients.blocks.header')
@include('clients.blocks.banner')

<section class="container" style="margin: 50px auto; max-width: 800px;">
    <div class="invoice-container card">
        <h2 class="invoice-header">Chi Tiết Hóa Đơn</h2>
        <p class="invoice-message">Dưới đây là thông tin hóa đơn của bạn.</p>

        <div class="invoice-details">
            <h3 class="details-header">Thông Tin Hóa Đơn</h3>
            <div class="details-content">
                <p><strong>Mã hóa đơn:</strong> {{ $invoice->invoiceId }}</p>
                <p><strong>Mã đơn hàng:</strong> {{ $invoice->bookingId }}</p>
                <p><strong>Số tiền:</strong> {{ number_format($invoice->amount, 0, ',', '.') }} VNĐ</p>
                <p><strong>Ngày phát hành:</strong> {{ \Carbon\Carbon::parse($invoice->dateIssued)->format('d-m-Y') }}</p>
                <p><strong>Chi tiết:</strong> {{ $invoice->details }}</p>
            </div>
        </div>

        <div class="button-group">
            <a href="{{ route('booking-success') }}" class="invoice-btn btn-back">Quay Lại Đơn Hàng</a>
            <a href="{{ route('home') }}" class="invoice-btn btn-home">Về Trang Chủ</a>
        </div>
    </div>
</section>

@include('clients.blocks.footer')

<style>
.invoice-container {
    padding: 30px;
    text-align: center;
}

.invoice-header {
    font-size: 28px;
    color: #333;
    margin-bottom: 15px;
}

.invoice-message {
    font-size: 16px;
    color: #555;
    margin-bottom: 30px;
}

.invoice-details {
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

.invoice-btn {
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    text-decoration: none;
    color: white;
    transition: background 0.3s;
    display: inline-block;
}

.btn-back {
    background: #6c757d;
}

.btn-back:hover {
    background: #5a6268;
}

.btn-home {
    background: #007bff;
}

.btn-home:hover {
    background: #0056b3;
}

@media (max-width: 768px) {
    .button-group {
        flex-direction: column;
        gap: 10px;
    }

    .invoice-btn {
        width: 100%;
    }
}
</style>