@extends('user.layout.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="row shadow-lg bg-white overflow-hidden"
        style="max-width: 900px; width: 100%; border-radius: 16px; margin: 40px auto;">

        <!-- Ảnh minh họa -->
        <div class="col-md-6 d-none d-md-flex justify-content-center align-items-center p-4" style="background: #eaf4ff;">
            <img src="{{ asset('user/assets/img/forgot.png') }}" alt="Forgot Password Illustration" class="img-fluid">
        </div>

        <!-- Form -->
        <div class="col-md-6 p-4">
            <h3 class="text-center text-uppercase mb-3" style="color: #247cff;">Quên mật khẩu</h3>
            <p class="text-center small text-muted mb-4">Vui lòng nhập email đăng nhập của bạn, chúng tôi sẽ gửi mã xác nhận qua email này.</p>

            <form action="{{ route('user.forgot') }}" method="POST" class="form">
                @csrf

                <div class="mb-4">
                    <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" id="email"
                        class="form-control rounded @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" placeholder="Nhập email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn w-100 text-white"
                    style="background: #247cff; border-radius: 8px; font-weight: 600;">
                    Gửi mã xác nhận
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
