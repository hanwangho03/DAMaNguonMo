@include('admin.blocks.adminheader')

<div class="container-fluid mt-4">
    <h2 class="text-center text-primary">Thêm User Mới</h2>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="phoneNumber" class="form-control" value="{{ old('phoneNumber') }}">
                </div>
                
                <div class="mb-3">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                </div>
                
                <div class="mb-3">
                    <label>Active</label>
                    <select name="isActive" class="form-control">
                        <option value="y">Yes</option>
                        <option value="n">No</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="a">Active</option>
                        <option value="b">Banned</option>
                        <option value="d">Deleted</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label>Is Admin</label>
                    <select name="isAdmin" class="form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Thêm mới</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>