@extends('user.auth.layout_profile')

@section('content_profile')
    <form action="{{ route('user.change-password') }}" method="POST" class="p-3">
        @csrf
        <h5 class="mb-4">🔒 Đổi mật khẩu</h5>

        <div class="mb-3">
            <label for="now_pass" class="form-label">Mật khẩu hiện tại <span class="text-danger">*</span></label>
            <input type="password" id="now_pass"
                class="form-control @error('now_pass') is-invalid @enderror"
                name="now_pass" placeholder="Nhập mật khẩu hiện tại">
            @error('now_pass')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new-pass" class="form-label">Mật khẩu mới <span class="text-danger">*</span></label>
            <input type="password" id="new-pass"
                class="form-control @error('password') is-invalid @enderror"
                name="password" placeholder="Nhập mật khẩu mới">
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="confirm" class="form-label">Xác nhận mật khẩu <span class="text-danger">*</span></label>
            <input type="password" id="confirm" class="form-control"
                name="password_confirmation" placeholder="Xác nhận mật khẩu mới">
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-shield-lock-fill me-1"></i> Cập nhật
        </button>
    </form>
@endsection
