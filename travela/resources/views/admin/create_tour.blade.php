@include('admin.blocks.adminheader')

    <div class="container-fluid mt-4">
        <h2 class="text-center text-primary">Đây là trang thêm tour</h2>
    </div>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center mb-0">Thêm Tour Du Lịch</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-store-tour') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Tên Tour -->
                    <div class="mb-3">
                        <label class="form-label">Tên Tour</label>
                        <input type="text" name="titlle" class="form-control" required>
                    </div>

                    <!-- Mô Tả -->
                    <div class="mb-3">
                        <label class="form-label">Mô Tả</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>

                    <!-- Ảnh Tour -->
                    <div class="mb-3">
                        <label class="form-label">Ảnh Tour</label>
                        <input type="file" name="images[]" class="form-control" multiple required>
                    </div>

                    <!-- Số Lượng -->
                    <div class="mb-3">
                        <label class="form-label">Số Lượng</label>
                        <input type="number" name="quantity" class="form-control" min="1" required>
                    </div>

                    <div class="row">
                        <!-- Giá Người Lớn -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giá Người Lớn (VND)</label>
                            <input type="number" name="priceAdult" class="form-control" min="0" required>
                        </div>

                        <!-- Giá Trẻ Em -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giá Trẻ Em (VND)</label>
                            <input type="number" name="priceChild" class="form-control" min="0" required>
                        </div>
                    </div>

                    <!-- Điểm Đến -->
                    <div class="mb-3">
                        <label class="form-label">Điểm Đến</label>
                        <input type="text" name="destination" class="form-control" required>
                    </div>

                    <!-- Hành Trình -->
                    <div class="mb-3">
                        <label class="form-label">Lịch Trình</label>
                        <input type="text" name="itinerary" class="form-control" required>
                    </div>

                    <!-- Ngày Bắt Đầu & Ngày Kết Thúc -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày Bắt Đầu</label>
                            <input type="date" name="startDate" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày Kết Thúc</label>
                            <input type="date" name="endDate" class="form-control" required>
                        </div>
                    </div>

                    <!-- Trạng Thái Tour -->
                    <div class="form-check form-switch mb-3">
                        <input type="hidden" name="availability" value="off">
                        <input class="form-check-input" type="checkbox" name="availability" id="availabilitySwitch" checked>
                        <label class="form-check-label" for="availabilitySwitch">Còn chỗ</label>
                    </div>

                    <!-- Đánh Giá -->
                    <div class="mb-3">
                        <label class="form-label">Đánh Giá (Tùy Chọn)</label>
                        <input type="text" name="reviews" class="form-control">
                    </div>

                    <!-- Nút Submit -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success px-4">Thêm Tour</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>