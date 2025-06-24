@extends('user.auth.layout_profile')

@section('content_profile')
    <form action="{{ route('user.account-edit') }}" method="POST" class="p-3">
        @csrf

        <h5 class="mb-4">👤 Thay đổi hồ sơ</h5>

        <div class="row g-3">
            {{-- Email (disabled) --}}
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>

            {{-- Họ tên --}}
            <div class="col-md-6">
                <label for="name" class="form-label">Họ tên <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}" placeholder="Nhập họ tên">
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Số điện thoại --}}
            <div class="col-md-6">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" id="phone" name="phone"
                    class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $user->phone) }}" placeholder="Nhập số điện thoại">
                @error('phone')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Địa chỉ --}}
            <div class="col-md-6">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" id="address" name="address"
                    class="form-control"
                    value="{{ old('address', $user->address) }}" placeholder="Nhập địa chỉ">
            </div>

            {{-- Mã bệnh nhân --}}
            <div class="col-md-6">
                <label for="patient_code" class="form-label">Mã bệnh nhân</label>
                <input type="text" id="patient_code" name="patient_code"
                    class="form-control"
                    value="{{ old('patient_code', $user->patient_code) }}" placeholder="Nhập mã bệnh nhân">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-save me-1"></i> Cập nhật
            </button>
        </div>
    </form>
@endsection
