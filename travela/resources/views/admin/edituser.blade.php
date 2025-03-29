<!-- resources/views/admin/users/edit.blade.php -->
@include('admin.blocks.adminheader')

<div class="container-fluid mt-4">
    <h2 class="text-center text-primary">Chỉnh sửa User</h2>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user->userId) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                </div>
                
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                
                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="phoneNumber" class="form-control" value="{{ $user->phoneNumber }}">
                </div>
                
                <div class="mb-3">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                </div>
                
                <div class="mb-3">
                    <label>Active</label>
                    <select name="isActive" class="form-control">
                        <option value="y" {{ $user->isActive == 'y' ? 'selected' : '' }}>Yes</option>
                        <option value="n" {{ $user->isActive == 'n' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="a" {{ $user->status == 'a' ? 'selected' : '' }}>Active</option>
                        <option value="b" {{ $user->status == 'b' ? 'selected' : '' }}>Banned</option>
                        <option value="d" {{ $user->status == 'd' ? 'selected' : '' }}>Deleted</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label>Is Admin</label>
                    <select name="isAdmin" class="form-control">
                        <option value="1" {{ $user->isAdmin ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $user->isAdmin ? '' : 'selected' }}>No</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>