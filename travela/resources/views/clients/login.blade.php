@include('clients.blocks.header')

<!-- Link đến file CSS -->
<link rel="stylesheet" href="{{ asset('clients/assets/css/css-login/style.css') }}">

<div class="login-template">
    <div class="main">
        <!-- Sign in Form -->
        <section class="sign-in show" id="sign-in-form">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('clients/assets/images/login/signin-image.jpg') }}" alt="sign in image"></figure>
                        <!-- Thêm icon và liên kết form đăng ký -->
                        <a href="javascript:void(0)" class="signup-image-link" id="sign-up">
                            <i class="zmdi zmdi-account-add"></i> Tạo tài khoản
                        </a>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Đăng nhập</h2>
                        <form method="POST" class="login-form" id="login-form">
                            @csrf
                            <div class="form-group">
                                <label for="username_login"><i class="zmdi zmdi-account"></i></label>
                                <input type="text" name="username_login" id="username_login" placeholder="Tên đăng nhập" required/>
                                <div class="invalid-feedback" id="validate_username"></div>
                            </div>
                            <div class="form-group">
                                <label for="password_login"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_login" id="password_login" placeholder="Mật khẩu" required/>
                                <div class="invalid-feedback" id="validate_password"></div>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Đăng nhập" />
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
                        <form method="POST" class="register-form" id="register-form">
                            @csrf
                            <div class="form-group">
                                <label for="username_register"><i class="zmdi zmdi-account"></i></label>
                                <input type="text" name="username_register" id="username_register" placeholder="Tên tài khoản" required/>
                                <div class="invalid-feedback" id="validate_username_regis"></div>
                            </div>
                            <div class="form-group">
                                <label for="email_register"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email_register" id="email_register" placeholder="Email" required/>
                                <div class="invalid-feedback" id="validate_email_regis"></div>
                            </div>
                            <div class="form-group">
                                <label for="password_register"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_register" id="password_register" placeholder="Mật khẩu" required/>
                                <div class="invalid-feedback" id="validate_password_regis"></div>
                            </div>
                            <div class="form-group">
                                <label for="re_pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Nhập lại mật khẩu" required/>
                                <div class="invalid-feedback" id="validate_repass"></div>
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

<!-- Thêm script để xử lý chuyển đổi form -->
<script>
    document.getElementById('sign-up').addEventListener('click', function () {
        document.getElementById('sign-in-form').style.display = 'none';
        document.getElementById('sign-up-form').style.display = 'block';
    });

    document.getElementById('sign-in').addEventListener('click', function () {
        document.getElementById('sign-in-form').style.display = 'block';
        document.getElementById('sign-up-form').style.display = 'none';
    });
</script>

@include('clients.blocks.footer')
