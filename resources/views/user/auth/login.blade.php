@extends('user.layout.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="row bg-white overflow-hidden shadow-lg"
        style="max-width: 900px; width: 100%; border-radius: 16px; margin: 40px auto;">

        <!-- Ảnh -->
        <div class="col-md-6 d-none d-md-flex justify-content-center align-items-center p-4" style="background: #eaf4ff;">
            <img src="{{ asset('user/assets/img/login.png') }}" alt="Login Illustration" class="img-fluid">
        </div>

        <!-- Form -->
        <div class="col-md-6 p-4">
            <h3 class="text-center text-uppercase mb-4" style="color: #247cff;">ĐĂNG NHẬP</h3>
            <form action="{{ route('user.login') }}" method="POST" class="form">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" id="email" class="form-control rounded @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" placeholder="Nhập email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" id="password"
                        class="form-control rounded @error('password') is-invalid @enderror"
                        name="password" placeholder="Nhập mật khẩu">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" name="remember" type="checkbox" id="remember" checked>
                        <label class="form-check-label ms-1" for="remember">Ghi nhớ đăng nhập</label>
                    </div>
                    <a href="{{ route('user.forgot') }}" class="text-decoration-none text-primary">Quên mật khẩu?</a>
                </div>

                <button type="submit" class="btn w-100 mb-3 text-white"
                    style="background: #247cff; border-radius: 8px; font-weight: 600;">Đăng nhập</button>

                <p class="text-center small text-muted mb-2">Hoặc đăng nhập với</p>

                <a href="{{ route('user.google-login') }}"
                    class="btn w-100 btn-outline-primary d-flex align-items-center justify-content-center"
                    style="border-radius: 8px; font-weight: 500; transition: 0.3s ease;">
                    Google
                </a>

                <p class="text-center mt-4 mb-0">Bạn chưa có tài khoản?
                    <a class="text-danger" href="{{ route('user.register') }}">Đăng ký</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
