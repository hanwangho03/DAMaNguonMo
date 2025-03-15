<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private $login;
    protected $user;

    public function __construct()
    {
        $this->login = new Login();
        $this->user = new Users();
    }

    public function index()
    {
        $title = 'Đăng nhập';
        return view('clients.login', compact('title'));
    }
    public function register(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào
        $request->validate([
            'username_register' => 'required|min:4|unique:user,username',
            'email_register'    => 'required|email|unique:user,email',
            'password_register' => 'required|min:6',
            're_pass'           => 'required|same:password_register'
        ], [
            'username_register.required' => 'Tên đăng nhập không được để trống!',
            'username_register.min'      => 'Tên đăng nhập phải có ít nhất 4 ký tự!',
            'username_register.unique'   => 'Tên đăng nhập đã tồn tại!',
            'email_register.required'    => 'Email không được để trống!',
            'email_register.email'       => 'Email không hợp lệ!',
            'email_register.unique'      => 'Email đã tồn tại!',
            'password_register.required' => 'Mật khẩu không được để trống!',
            'password_register.min'      => 'Mật khẩu phải có ít nhất 6 ký tự!',
            're_pass.required'           => 'Bạn cần nhập lại mật khẩu!',
            're_pass.same'               => 'Mật khẩu nhập lại không khớp!'
        ]);
    
        // Nếu validation thành công, lưu vào database
        $dataInsert = [
            'username' => $request->username_register,
            'email'    => $request->email_register,
            'password' => Hash::make($request->password_register), // Mã hóa mật khẩu
        ];
    
        $this->login->registerAcount($dataInsert);
        
        return redirect()->back()->with('message', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    public function login(Request $request)
    {
        $username = $request->username_login;
        $password = $request->password_login;
    
        // Kiểm tra đầu vào
        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Vui lòng nhập đầy đủ thông tin đăng nhập!');
        }
    
        // Tìm user trong database
        $user = $this->user->where('username', $username)->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'Tên đăng nhập không tồn tại!');
        }
    
        // Kiểm tra mật khẩu
        if (!password_verify($password, $user->password)) {
            return redirect()->back()->with('error', 'Mật khẩu không chính xác!');
        }
    
        // Đăng nhập thành công
        $request->session()->put('username', $username);
    
        return redirect()->route('home')->with('message', 'Đăng nhập thành công!');
    }
    
    public function logout(Request $request)
    {
        $request->session()->flush(); // Xóa toàn bộ session
        return redirect()->route('login')->with('message', 'Bạn đã đăng xuất thành công!');
    }
    
}
