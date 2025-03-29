<!-- resources/views/admin/users.blade.php -->
@include('admin.blocks.adminheader')

<div class="container-fluid mt-4">
    <h2 class="text-center text-primary">Quản lý User</h2>
    
    <!-- Nút thêm user mới -->
    <div class="mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">Thêm User Mới</a>
    </div>

    <!-- Bảng danh sách user -->
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Active</th>
                        <th>Status</th>
                        <th>Admin</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->userId }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phoneNumber }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->isActive == 'y' ? 'Yes' : 'No' }}</td>
                        <td>
                            @if($user->status == 'd')
                                <span class="badge bg-danger">Deleted</span>
                            @elseif($user->status == 'b')
                                <span class="badge bg-warning">Banned</span>
                            @else
                                <span class="badge bg-success">Active</span>
                            @endif
                        </td>
                        <td>{{ $user->isAdmin ? 'Yes' : 'No' }}</td>
                        <td>{{ $user->createdDate }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->userId) }}" class="btn btn-sm btn-primary">Sửa</a>
                            <form action="{{ route('admin.users.delete', $user->userId) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa user này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Phân trang -->
            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>