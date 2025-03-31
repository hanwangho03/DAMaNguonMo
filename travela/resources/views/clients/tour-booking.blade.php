@include('clients.blocks.header')
@include('clients.blocks.banner')

<section class="container" style="margin: 50px auto; max-width: 1200px;">
    <!-- Hiển thị thông báo nếu có -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('store-booking') }}" method="POST" class="booking-container">
        @csrf
        <input type="hidden" name="tourId" value="{{ $tour->tourId }}">

        <!-- Phần còn lại của form giữ nguyên -->
        <div class="booking-wrapper">
            <!-- Left Column: Contact Information and Privacy -->
            <div class="left-column">
                <!-- Contact Information -->
                <div class="booking-info card">
                    <h2 class="booking-header">Thông Tin Liên Lạc</h2>
                    <div class="booking__infor">
                        <div class="form-group">
                            <label for="username">Họ và tên*</label>
                            <input type="text" id="username" name="fullName" value="{{ old('fullName', $user->fullName ?? '') }}" required>
                           .@error('fullName')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email*</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tel">Số điện thoại*</label>
                            <input type="number" id="tel" name="phoneNumber" value="{{ old('phoneNumber', $user->phoneNumber ?? '') }}" required>
                            @error('phoneNumber')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ*</label>
                            <input type="text" id="address" name="address" value="{{ old('address', $user->address ?? '') }}" required>
                            @error('address')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Privacy Agreement Section -->
                <div class="privacy-section card">
                    <h3 class="privacy-header">Điều Khoản Dịch Vụ</h3>
                    <p class="privacy-text">Bằng cách nhấp vào nút "Đồng Ý" dưới đây, quý khách xác nhận đã đọc và đồng ý với các điều kiện điều khoản dịch vụ của Travela. Vui lòng xem chi tiết <a href="#" target="_blank" class="terms-link">tại đây</a>.</p>
                    <div class="privacy-checkbox">
                        <input type="checkbox" id="agree" name="agree" checked>
                        <label for="agree" class="checkbox-label">Tôi đã đọc và đồng ý với <a href="#" target="_blank" class="terms-link">Điều khoản thanh toán</a></label>
                    </div>
                    <p class="error-message" id="agree-error" style="display: none;">Vui lòng đồng ý với điều khoản dịch vụ để tiếp tục thanh toán.</p>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="booking-summary card">
                <div class="summary-section">
                    <div class="tour-info">
                        <p>Mã tour: {{ $tour->tourId }}</p>
                        <h5 class="widget-title">{{ $tour->titlle }}</h5>
                        <p>Ngày khởi hành: {{ $tour->startDate }}</p>
                        <p>Ngày kết thúc: {{ $tour->endDate }}</p>
                    </div>

                    <div class="order-summary">
                        <div class="summary-item">
                            <span>Người lớn:</span>
                            <div>
                                <input type="number" name="numAdult" id="numAdult" value="1" min="1" class="quantity-input">
                                <span>x</span>
                                <span class="price" id="adultPrice">{{ number_format($tour->priceAdult, 0, ',', '.') }} VNĐ</span>
                            </div>
                        </div>
                        <div class="summary-item">
                            <span>Trẻ em:</span>
                            <div>
                                <input type="number" name="numChild" id="numChild" value="0" min="0" class="quantity-input">
                                <span>x</span>
                                <span class="price" id="childPrice">{{ number_format($tour->priceChild, 0, ',', '.') }} VNĐ</span>
                            </div>
                        </div>
                        <div class="summary-item total">
                            <span>Tổng cộng:</span>
                            <span class="price" id="totalPrice">0 VNĐ</span>
                            <input type="hidden" name="totalPrice" id="totalPriceInput">
                        </div>
                    </div>

                    <div class="button-group">
                        <a href="{{ route('tour-detail', ['id' => $tour->tourId]) }}" class="booking-btn btn-cancel">Hủy Thanh Toán</a>
                        <button type="submit" class="booking-btn btn-pay">Thanh Toán</button>
                        <button type="button" class="booking-btn btn-vnpay">Thanh Toán bằng VNPay</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Form ẩn để gửi dữ liệu đến route pay-with-vnpay -->
    <form id="vnpay-form" action="{{ route('pay-with-vnpay') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="tourId" value="{{ $tour->tourId }}">
        <input type="hidden" name="numAdult" id="vnpay-numAdult">
        <input type="hidden" name="numChild" id="vnpay-numChild">
        <input type="hidden" name="totalPrice" id="vnpay-totalPrice">
        <input type="hidden" name="fullName" id="vnpay-fullName">
        <input type="hidden" name="email" id="vnpay-email">
        <input type="hidden" name="phoneNumber" id="vnpay-phoneNumber">
        <input type="hidden" name="address" id="vnpay-address">
    </form>
</section>

@include('clients.blocks.footer')

<script>
    // Hàm tính tổng giá
    function updateTotalPrice() {
        let numAdult = parseInt(document.getElementById("numAdult").value) || 0;
        let numChild = parseInt(document.getElementById("numChild").value) || 0;
        let adultPrice = {{ $tour->priceAdult }}; // Truyền giá trị trực tiếp từ PHP
        let childPrice = {{ $tour->priceChild }}; // Truyền giá trị trực tiếp từ PHP

        let total = (numAdult * adultPrice) + (numChild * childPrice);
        document.getElementById("totalPrice").innerText = total.toLocaleString('vi-VN') + " VNĐ";
        document.getElementById("totalPriceInput").value = total;
    }

    // Hàm bật/tắt nút "Thanh toán" và "Thanh toán bằng VNPay" dựa trên checkbox điều khoản
    function togglePayButton() {
        let agreeCheckbox = document.getElementById("agree");
        let payButton = document.querySelector(".btn-pay");
        let vnpayButton = document.querySelector(".btn-vnpay");
        let errorMessage = document.getElementById("agree-error");

        if (!agreeCheckbox.checked) {
            payButton.disabled = true;
            vnpayButton.disabled = true; // Tắt nút VNPay
            errorMessage.style.display = "block"; // Hiển thị thông báo
        } else {
            payButton.disabled = false;
            vnpayButton.disabled = false; // Bật nút VNPay
            errorMessage.style.display = "none"; // Ẩn thông báo
        }
    }

    // Hàm đồng bộ dữ liệu từ form chính sang form VNPay
    function syncVNPayForm() {
        document.getElementById("vnpay-numAdult").value = document.getElementById("numAdult").value;
        document.getElementById("vnpay-numChild").value = document.getElementById("numChild").value;
        document.getElementById("vnpay-totalPrice").value = document.getElementById("totalPriceInput").value;
        document.getElementById("vnpay-fullName").value = document.getElementById("username").value;
        document.getElementById("vnpay-email").value = document.getElementById("email").value;
        document.getElementById("vnpay-phoneNumber").value = document.getElementById("tel").value;
        document.getElementById("vnpay-address").value = document.getElementById("address").value;
    }

    // Thêm sự kiện cho các input
    document.getElementById("numAdult").addEventListener("change", updateTotalPrice);
    document.getElementById("numChild").addEventListener("change", updateTotalPrice);
    document.getElementById("agree").addEventListener("change", togglePayButton);

    // Thêm sự kiện cho nút "Thanh toán bằng VNPay"
    document.querySelector(".btn-vnpay").addEventListener("click", function () {
        syncVNPayForm(); // Đồng bộ dữ liệu trước khi gửi
        document.getElementById("vnpay-form").submit(); // Gửi form VNPay
    });

    // Gọi các hàm khi tải trang
    updateTotalPrice();
    togglePayButton();
</script>

@include('clients.blocks.footer')

<style>
.booking-container {
    padding: 20px;
}

.booking-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 100px;
}

.left-column {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 25px;
}

.booking-header {
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}

.error-message {
    color: #dc3545;
    /* Màu đỏ */
    font-size: 13px;
    margin-top: 8px;
    font-style: italic;
}

.booking__infor {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 25px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
}

.form-group input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background: #f8f9fa;
    font-size: 16px;
}

.privacy-section {
    padding: 15px;
    background: #f8f9fa;
}

.privacy-checkbox {
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.tour-info {
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.widget-title {
    color: #007bff;
    font-size: 22px;
    margin: 15px 0;
}

.order-summary {
    padding: 20px 0;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.summary-item.total {
    font-weight: bold;
    font-size: 18px;
    color: #333;
    margin-top: 15px;
}

.quantity-input {
    width: 50px;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-align: center;
}

.price {
    color: #28a745;
}

.button-group {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.booking-btn {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    /* Để thẻ <a> trông giống button */
    display: inline-block;
    /* Để thẻ <a> tuân theo width */
    cursor: pointer;
    transition: background 0.3s;
}

.btn-cancel {
    background: #dc3545;
    color: white;
}

.btn-cancel:hover {
    background: #c82333;
}

.btn-pay {
    background: #28a745;
    color: white;
}

.btn-pay:hover {
    background: #218838;
}

@media (max-width: 768px) {
    .booking-wrapper {
        grid-template-columns: 1fr;
    }

    .button-group {
        flex-direction: column;
        gap: 10px;
    }
}

/* Privacy Section Styling */
.privacy-section {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
}

.privacy-header {
    font-size: 20px;
    color: #333;
    margin-bottom: 15px;
    font-weight: 600;
    border-bottom: 1px solid #ddd;
    padding-bottom: 8px;
}

.privacy-text {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 15px;
}

.privacy-checkbox {
    display: flex;
    align-items: center;
    gap: 10px;
}

.privacy-checkbox input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: #007bff;
    /* Màu xanh khi được tick */
    cursor: pointer;
}

.checkbox-label {
    font-size: 14px;
    color: #555;
    line-height: 1.4;
}

.terms-link {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
}

.terms-link:hover {
    text-decoration: underline;
    color: #0056b3;
}
.btn-vnpay {
    background-color: #007bff;
    color: white;
}
</style>