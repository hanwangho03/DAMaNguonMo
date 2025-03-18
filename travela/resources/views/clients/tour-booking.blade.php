@include('clients.blocks.header')
@include('clients.blocks.banner')

<section class="container" style="margin: 50px auto; max-width: 1200px;">
    <<form action="{{ route('store-booking') }}" method="POST" class="booking-container">
        @csrf
        <input type="hidden" name="tourId" value="{{ $tour->tourId  }}">

        <div class="booking-wrapper">
            <!-- Left Column: Contact Information and Privacy -->
            <div class="left-column">
                <!-- Contact Information -->
                <div class="booking-info card">
                    <h2 class="booking-header">Thông Tin Liên Lạc</h2>
                    <div class="booking__infor">
                        <div class="form-group">
                            <label for="username">Họ và tên*</label>
                            <input type="text" id="username" name="fullName" value="{{ old('fullName') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email*</label>
                            <input type="text" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tel">Số điện thoại*</label>
                            <input type="number" id="tel" name="phoneNumber" value="{{ old('phoneNumber') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ*</label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                        </div>
                    </div>
                </div>
                <!-- Privacy Agreement Section -->
                <div class="privacy-section card">
                    <h3 class="privacy-header">Điều Khoản Dịch Vụ</h3>
                    <p class="privacy-text">Bằng cách nhấp vào nút "Đồng Ý" dưới đây, quý khách xác nhận đã đọc và đồng
                        ý với các điều kiện điều khoản dịch vụ của Travela. Vui lòng xem chi tiết <a href="#"
                            target="_blank" class="terms-link">tại đây</a>.</p>
                    <div class="privacy-checkbox">
                        <input type="checkbox" id="agree" name="agree" checked>
                        <label for="agree" class="checkbox-label">Tôi đã đọc và đồng ý với <a href="#" target="_blank"
                                class="terms-link">Điều khoản thanh toán</a></label>
                    </div>
                    <p class="error-message" id="agree-error" style="display: none;">Vui lòng đồng ý với điều khoản dịch
                        vụ để tiếp tục thanh toán.</p>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="booking-summary card">
                <div class="summary-section">
                    <div class="tour-info">
                        <p>Mã tour: {{ $tour->tourId }}</p>
                        <h5 class="widget-title">{{ $tour->titlle }}</h5> <!-- Sửa thành $tour->title nếu cần -->
                        <p>Ngày khởi hành: {{ $tour->startDate }}</p>
                        <p>Ngày kết thúc: {{ $tour->endDate }}</p>
                    </div>

                    <div class="order-summary">
                        <div class="summary-item">
                            <span>Người lớn:</span>
                            <div>
                                <input type="number" name="numAdult" id="numAdult" value="1" min="1"
                                    class="quantity-input">
                                <span>x</span>
                                <span class="price" id="adultPrice">{{ number_format($tour->priceAdult, 0, ',', '.') }}
                                    VNĐ</span>
                            </div>
                        </div>
                        <div class="summary-item">
                            <span>Trẻ em:</span>
                            <div>
                                <input type="number" name="numChild" id="numChild" value="0" min="0"
                                    class="quantity-input">
                                <span>x</span>
                                <span class="price" id="childPrice">{{ number_format($tour->priceChild, 0, ',', '.') }}
                                    VNĐ</span>
                            </div>
                        </div>
                        <div class="summary-item total">
                            <span>Tổng cộng:</span>
                            <span class="price" id="totalPrice">0 VNĐ</span>
                            <input type="hidden" name="totalPrice" id="totalPriceInput">
                        </div>
                    </div>

                    <div class="button-group">
                        <a href="{{ route('tour-detail', ['id' => $tour->tourId]) }}" class="booking-btn btn-cancel">Hủy
                            Thanh Toán</a>
                        <button type="submit" class="booking-btn btn-pay">Thanh Toán</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<script>
    function updateTotalPrice() {
        let numAdult = parseInt(document.getElementById("numAdult").value) || 0;
        let numChild = parseInt(document.getElementById("numChild").value) || 0;
        let adultPrice = {{ $tour->priceAdult }}; // Truyền giá trị trực tiếp từ PHP
        let childPrice = {{ $tour->priceChild }}; // Truyền giá trị trực tiếp từ PHP

        let total = (numAdult * adultPrice) + (numChild * childPrice);
        document.getElementById("totalPrice").innerText = total.toLocaleString('vi-VN') + " VNĐ";
        document.getElementById("totalPriceInput").value = total;
    }

    function togglePayButton() {
        let agreeCheckbox = document.getElementById("agree");
        let payButton = document.querySelector(".btn-pay");
        let errorMessage = document.getElementById("agree-error");

        if (!agreeCheckbox.checked) {
            payButton.disabled = true;
            errorMessage.style.display = "block"; // Hiển thị thông báo
        } else {
            payButton.disabled = false;
            errorMessage.style.display = "none"; // Ẩn thông báo
        }
    }

    document.getElementById("numAdult").addEventListener("change", updateTotalPrice);
    document.getElementById("numChild").addEventListener("change", updateTotalPrice);
    document.getElementById("agree").addEventListener("change", togglePayButton);

    updateTotalPrice(); // Gọi khi tải trang
    togglePayButton();  // Gọi khi tải trang
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
</style>