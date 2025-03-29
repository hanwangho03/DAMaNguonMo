@include('admin.blocks.adminheader')

<div class="container-fluid mt-4">
    <h2 class="text-center text-primary">Quản lý Comment</h2>

    {{-- Thông báo khi có hành động --}}
    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    {{-- Bảng hiển thị comment --}}
    <table class="table table-striped table-bordered mt-4">
        <thead class="table-primary text-center">
            <tr>
                <th>ID</th>
                <th>Tour ID</th>
                <th>User ID</th>
                <th>Bình luận</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
            <tr>
                <td>{{ $review->reviewId }}</td>
                <td>{{ $review->tourId }}</td>
                <td>{{ $review->userId }}</td>
                <td>{{ $review->comment }}</td>
                <td>{{ $review->timestamp }}</td>
                <td>{{ $review->hidden ? 'Ẩn' : 'Hiển thị' }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('admin.comments.toggle', $review->reviewId) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            @if ($review->hidden == 1)
                            <button type="submit" class="btn btn-sm btn-warning">Hiện</button>
                            @else
                            <button type="submit" class="btn btn-sm btn-secondary">Ẩn</button>
                            @endif
                        </form>
                        <form action="{{ route('admin.comments.destroy', $review->reviewId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Không có bình luận nào</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $reviews->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>