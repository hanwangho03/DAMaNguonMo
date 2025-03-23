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
        $users = Users::paginate(10); // Lấy 10 user mỗi trang
        return view('admin.users', compact('users'));
    }


}