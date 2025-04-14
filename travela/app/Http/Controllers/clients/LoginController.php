<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
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

        $dataInsert = [
            'username' => $request->username_register,
            'email'    => $request->email_register,
            'password' => Hash::make($request->password_register),
            'isAdmin'  => 0,
        ];

        $this->login->registerAcount($dataInsert);

        return redirect()->back()->with('message', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
    
    public function handleGoogleCallback(Request $request)
    {
        $code = $request->get('code');
    
        if (!$code) {
            return redirect()->route('login')->with('error', 'Đăng nhập Google thất bại!');
        }
    
        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'client_id'     => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri'  => env('GOOGLE_REDIRECT_URI'),
            'grant_type'    => 'authorization_code',
            'code'          => $code,
        ]);
    
        $token = $response->json()['access_token'] ?? null;
    
        if (!$token) {
            return redirect()->route('login')->with('error', 'Không thể lấy token từ Google!');
        }
    
        $googleUser = Http::withToken($token)->get('https://www.googleapis.com/oauth2/v2/userinfo')->json();
    
        if (!$googleUser || !isset($googleUser['email'])) {
            return redirect()->route('login')->with('error', 'Không thể lấy thông tin từ Google!');
        }
    
        $user = Users::where('email', $googleUser['email'])->first();
    
        if (!$user) {
            $user = Users::create([
                'username' => $googleUser['name'],
                'email'    => $googleUser['email'],
                'password' => bcrypt('google_auth_no_password'),
                'isAdmin'  => 0,
            ]);
        }
    
        Auth::login($user);
    
        session([
            'userId'   => $user->userId, 
            'username' => $user->username,
            'isAdmin'  => $user->isAdmin
        ]);
    
        return redirect()->route('home')->with('message', 'Đăng nhập Google thành công!');
    }
    

    public function login(Request $request)
    {
        $username = $request->username_login;
        $password = $request->password_login;
    
        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Vui lòng nhập đầy đủ thông tin đăng nhập!');
        }
    
        $user = $this->user->where('username', $username)->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'Tên đăng nhập không tồn tại!');
        }
    
        if ($user->status === 'd') {
            return redirect()->back()->with('error', 'Tài khoản này đã bị xóa và không thể đăng nhập!');
        }
        if ($user->status === 'b') {
            return redirect()->back()->with('error', 'Tài khoản này đã bị cấm, vui lòng liên hệ quản trị viên!');
        }
    
        if (!password_verify($password, $user->password)) {
            return redirect()->back()->with('error', 'Mật khẩu không chính xác!');
        }
    
        $request->session()->put('userId', $user->userId);
        $request->session()->put('username', $username);
        $request->session()->put('isAdmin', $user->isAdmin);
        $request->session()->save();
    
        if ($user->isAdmin) {
            return redirect()->route('admin.dashboard')->with('message', 'Đăng nhập thành công! Chào mừng Admin!');
        }
    
        return redirect()->route('home')->with('message', 'Đăng nhập thành công!');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('message', 'Bạn đã đăng xuất thành công!');
    }

    public function show($id)
    {
        $userModel = new Users();
        $user = $userModel->getUser($id);

        if (!$user) {
            return abort(404, 'Không tìm thấy người dùng.');
        }

        return view('clients.user_profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = $this->user->getUser($id);

        if (!$user || $request->session()->get('userId') != $id) {
            return redirect()->back()->with('error', 'Bạn không có quyền chỉnh sửa thông tin này.');
        }

        $request->validate([
            'email' => 'required|email|unique:user,email,' . $id . ',userId',
            'phoneNumber' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'old_password' => 'required_with:new_password|nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ], [
            'email.required' => 'Email không được để trống!',
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã được sử dụng!',
            'phoneNumber.max' => 'Số điện thoại không được vượt quá 15 ký tự!',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự!',
            'old_password.required_with' => 'Vui lòng nhập mật khẩu cũ khi thay đổi mật khẩu!',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự!',
            'new_password.confirmed' => 'Mật khẩu xác nhận không khớp!',
        ]);

        $data = [
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
            'updatedDate' => now(),
        ];

        if ($request->filled('new_password')) {
            if (!password_verify($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'Mật khẩu cũ không chính xác!');
            }
            $data['password'] = Hash::make($request->new_password);
        }

        $this->user->updateUser($id, $data);

        return redirect()->back()->with('message', 'Cập nhật thông tin thành công!');
    }
}