@extends('user.auth.layout_profile')

@section('content_profile')
<div class="row">
    <div class="col-md-3 text-center">
        <div class="position-relative d-inline-block">
            <img id="user-avatar" src="{{ Auth::user()->avatar ? Auth::user()->avatar : '/user/assets/img/default.jpg' }}"
                alt="User Avatar"
                class="rounded-circle img-fluid shadow"
                style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #247cff;">
            
            <div class="camera-icon" style="position: absolute; bottom: 0; right: 0; background: white; border-radius: 50%; padding: 6px;">
                <i class="fa fa-camera text-primary"
                   style="cursor: pointer; font-size: 18px;"
                   data-bs-toggle="tooltip"
                   title="Thay đổi ảnh"
                   onclick="document.getElementById('avatar-input').click();"></i>
            </div>
        </div>

        <form id="avatar-form" enctype="multipart/form-data">
            @csrf
            <input type="file" name="avatar" id="avatar-input" class="d-none" accept="image/*">
        </form>
    </div>

    <div class="col-md-9">
        <h5 class="mb-2">Xin chào, <span class="fw-bold text-primary">{{ Auth::user()->name }}</span></h5>
        <p class="text-muted">Từ trang tổng quan tài khoản của mình, bạn có thể theo dõi lịch sử khám, chữa bệnh của mình.</p>
        <a href="{{ route('user.medical-history') }}"
           style="font-weight: bold; color: #247cff; text-decoration: underline;">Xem lịch sử khám bệnh</a>
    </div>
</div>
@endsection


@section('js_profile')
    <script src="{{ asset('user/assets/js/custom/change-avatar.js') }}"></script>
@endsection
