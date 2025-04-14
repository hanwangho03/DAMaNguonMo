@include('clients.blocks.header')

<!-- Link đến file CSS -->
<link rel="stylesheet" href="{{ asset('clients/assets/css/css-login/style.css') }}">

<div class="login-template">
    <div class="main">
        <!-- Hiển thị thông báo từ session -->
        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        @if(session('message'))
            <div class="alert alert-success text-center">{{ session('message') }}</div>
        @endif

        <!-- Sign in Form -->
        <section class="sign-in show" id="sign-in-form">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('clients/assets/images/login/signin-image.jpg') }}" alt="sign in image"></figure>
                        <a href="javascript:void(0)" class="signup-image-link" id="sign-up">
                            <i class="zmdi zmdi-account-add"></i> Tạo tài khoản
                        </a>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Đăng nhập</h2>

                        <!-- Hiển thị lỗi khi nhập sai -->
                        @if ($errors->any() && old('username_login'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('user-login') }}" method="POST" class="login-form" id="login-form">
                            @csrf
                            <div class="form-group">
                                <label for="username_login"><i class="zmdi zmdi-account"></i></label>
                                <input type="text" name="username_login" id="username_login" placeholder="Tên đăng nhập" required value="{{ old('username_login') }}"/>
                                @error('username_login')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_login"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_login" id="password_login" placeholder="Mật khẩu" required/>
                                @error('password_login')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group button-group">
    <input type="submit" name="signin" id="signin" class="form-submit" value="Đăng nhập" />
    <a href="https://accounts.google.com/o/oauth2/auth?
client_id=396216587023-93140qvam94rh87jm0bkest2rppbq8pn.apps.googleusercontent.com
&redirect_uri=http://127.0.0.1:8000/auth/google/callback
&response_type=code
&scope=email%20profile"
class="form-submit google-login">
        <i class="fab fa-google"></i> Google
    </a>
</div>
                        </form>



                    </div>
                </div>
            </div>
        </section>

        <!-- Sign up Form -->
        <section class="signup" id="sign-up-form" style="display: none;">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Đăng ký</h2>

                        <!-- Hiển thị lỗi khi đăng ký sai -->
                        @if ($errors->any() && old('username_register'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST" class="register-form" id="register-form">
                            @csrf
                            <div class="form-group">
                                <label for="username_register"><i class="zmdi zmdi-account"></i></label>
                                <input type="text" name="username_register" id="username_register" placeholder="Tên tài khoản" required value="{{ old('username_register') }}"/>
                                @error('username_register')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email_register"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email_register" id="email_register" placeholder="Email" required value="{{ old('email_register') }}"/>
                                @error('email_register')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_register"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_register" id="password_register" placeholder="Mật khẩu" required/>
                                @error('password_register')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="re_pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Nhập lại mật khẩu" required/>
                                @error('re_pass')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Đăng ký" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{ asset('clients/assets/images/login/signup-image.jpg') }}" alt="sign up image"></figure>
                        <a href="javascript:void(0)" class="signup-image-link" id="sign-in">
                            <i class="zmdi zmdi-arrow-left"></i> Tôi đã có tài khoản rồi
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    document.getElementById('sign-up').addEventListener('click', function () {
        document.getElementById('sign-in-form').style.display = 'none';
        document.getElementById('sign-up-form').style.display = 'block';
    });

    document.getElementById('sign-in').addEventListener('click', function () {
        document.getElementById('sign-in-form').style.display = 'block';
        document.getElementById('sign-up-form').style.display = 'none';
    });

    @if ($errors->any() && old('username_register'))
        document.getElementById('sign-in-form').style.display = 'none';
        document.getElementById('sign-up-form').style.display = 'block';
    @endif
</script>

@include('clients.blocks.footer')
