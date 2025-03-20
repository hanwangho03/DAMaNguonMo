@include('admin.blocks.adminheader')

    <!-- Nội dung chính -->
    <div class="container-fluid mt-4">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="text-center text-primary">Chào mừng Admin!</h2>
        <p class="text-center">Đây là trang quản lý. Vui lòng chọn tab để bắt đầu.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>