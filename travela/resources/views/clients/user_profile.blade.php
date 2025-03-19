@include('clients.blocks.header')
@include('clients.blocks.banner')

<div class="container mt-5 mb-5">
    <h2 class="mb-4 text-center text-primary fw-bold">Thông Tin Người Dùng</h2>

    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($user)
        <div class="card shadow-sm rounded">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thông tin chi tiết</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user->userId) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Tên Đăng Nhập:</strong> {{ $user->username }} <small>(Không thể thay đổi)</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email"><strong>Email:</strong></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phoneNumber"><strong>Số Điện Thoại:</strong></label>
                            <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" value="{{ $user->phoneNumber }}">
                            @error('phoneNumber')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address"><strong>Địa Chỉ:</strong></label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}">
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Trạng Thái:</strong> 
                            <span class="badge 
                                {{ $user->status == 'active' ? 'bg-success' : 
                                   ($user->status == 'd' ? 'bg-danger' : 
                                   ($user->status == 'b' ? 'bg-warning' : 'bg-secondary')) }}">
                                {{ $user->status == 'd' ? 'Deleted' : 
                                   ($user->status == 'b' ? 'Banned' : ucfirst($user->status)) }}
                            </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Ngày Tạo:</strong> 
                            {{ $user->createdDate ? \Carbon\Carbon::parse($user->createdDate)->format('d/m/Y H:i') : 'Chưa có' }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Ngày Cập Nhật:</strong> 
                            {{ $user->updatedDate ? \Carbon\Carbon::parse($user->updatedDate)->format('d/m/Y H:i') : 'Chưa cập nhật' }}
                        </div>
                        <!-- Thay đổi mật khẩu -->
                        <div class="col-md-12 mb-3">
                            <h5 class="mt-3">Thay đổi mật khẩu (nếu cần)</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="old_password"><strong>Mật khẩu cũ:</strong></label>
                                    <input type="password" name="old_password" id="old_password" class="form-control">
                                    @error('old_password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="new_password"><strong>Mật khẩu mới:</strong></label>
                                    <input type="password" name="new_password" id="new_password" class="form-control">
                                    @error('new_password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="new_password_confirmation"><strong>Xác nhận mật khẩu mới:</strong></label>
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-danger text-center">
            <i class="fas fa-exclamation-triangle me-2"></i> Không tìm thấy thông tin người dùng.
        </div>
    @endif
</div>

@include('clients.blocks.footer')

<style>
    .card {
        border: none;
        background: #fff;
    }
    .card-header {
        border-radius: 10px 10px 0 0;
    }
    .card-body {
        padding: 20px;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
    }
    .col-md-6 {
        padding: 10px;
    }
    strong {
        color: #333;
        font-weight: 600;
    }
    .badge {
        font-size: 0.9em;
        padding: 5px 10px;
        border-radius: 12px;
    }
    .text-primary {
        color: #007bff !important;
    }
    .form-control {
        border-radius: 5px;
    }
    @media (max-width: 768px) {
        .col-md-6 {
            width: 100%;
        }
    }
</style>