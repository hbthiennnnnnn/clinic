@extends('user.layout.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="row shadow-lg rounded bg-white overflow-hidden"
        style="max-width: 900px; width: 100%; border-radius: 16px; margin: 40px auto;">

        <!-- Ảnh minh họa -->
        <div class="col-md-6 d-none d-md-flex justify-content-center align-items-center p-4"
            style="background: #eaf4ff;">
            <img src="{{ asset('user/assets/img/signup.png') }}" alt="Register Illustration" class="img-fluid">
        </div>

        <!-- Form đăng ký -->
        <div class="col-md-6 p-4">
            <h3 class="text-center text-uppercase mb-4" style="color: #247cff;">ĐĂNG KÝ</h3>
            <form action="{{ route('user.register') }}" method="POST" class="form">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="name">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" id="name"
                        class="form-control rounded @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" placeholder="Nhập họ tên">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" id="email"
                        class="form-control rounded @error('email') is-invalid @enderror"
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

                <div class="mb-4">
                    <label class="form-label" for="confirm">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" id="confirm" name="password_confirmation"
                        class="form-control rounded" placeholder="Xác nhận mật khẩu">
                </div>

                <button type="submit" class="btn w-100 text-white"
                    style="background: #247cff; border-radius: 8px; font-weight: 600;">Đăng ký</button>

                <p class="text-center mt-4 mb-0">Bạn đã có tài khoản?
                    <a class="text-danger" href="{{ route('user.login') }}">Đăng nhập</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
