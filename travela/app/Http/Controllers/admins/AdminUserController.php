<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Users; // Đảm bảo import model Users
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Hiển thị danh sách users
     */
    public function index()
    {
        $users = Users::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function create()
    {
        return view('admin.createuser');
    }

    /**
     * Lưu user mới vào database
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255|unique:user',
            'email' => 'required|email|max:255|unique:user',
            'password' => 'required|string|min:6',
            'phoneNumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'isActive' => 'required|in:y,n',
            'status' => 'required|in:a,b,d',
            'isAdmin' => 'required|boolean'
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['createdDate'] = now();
        $data['updatedDate'] = now();

        Users::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Thêm user thành công');
    }

    /**
     * Hiển thị form chỉnh sửa user
     */
    public function edit($id)
    {
        $usersModel = new Users();
        $user = $usersModel->getUser($id);
        
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User không tồn tại');
        }
        
        return view('admin.edituser', compact('user'));
    }

    /**
     * Cập nhật thông tin user
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'isActive' => 'required|in:y,n',
            'status' => 'required|in:a,b,d',
            'isAdmin' => 'required|boolean'
        ]);

        $usersModel = new Users();
        if (!$usersModel->getUser($id)) {
            return redirect()->route('admin.users.index')->with('error', 'User không tồn tại');
        }

        $data['updatedDate'] = now();
        $usersModel->updateUser($id, $data);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật user thành công');
    }

    /**
     * Xóa user (soft delete)
     */
    public function destroy($id)
    {
        $usersModel = new Users();
        if (!$usersModel->getUser($id)) {
            return redirect()->route('admin.users.index')->with('error', 'User không tồn tại');
        }

        $usersModel->updateUser($id, [
            'status' => 'd',
            'updatedDate' => now()
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Xóa user thành công');
    }
}