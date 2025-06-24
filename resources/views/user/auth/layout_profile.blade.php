@extends('user.layout.app')

@section('content')
    <div class="container py-5">
        <div class="row">
            {{-- Sidebar bên trái --}}
            <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                <div class="bg-white rounded-4 shadow-sm p-3 h-100">
                    <ul class="nav flex-column gap-2">
                        <li class="nav-item">
                            <a href="{{ route('user.overview') }}"
                               class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('user.overview') ? 'active' : '' }}">
                                <i class="bi bi-house-door"></i> Tổng quan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.medical-history') }}"
                               class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('user.medical-history') ? 'active' : '' }}">
                                <i class="bi bi-journal-medical"></i> Lịch sử khám bệnh
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.payment-history') }}"
                               class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('user.payment-history') ? 'active' : '' }}">
                                <i class="bi bi-cash-stack"></i> Lịch sử thanh toán
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.account-edit') }}"
                               class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('user.account-edit') ? 'active' : '' }}">
                                <i class="bi bi-person-lines-fill"></i> Thay đổi hồ sơ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.change-password') }}"
                               class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('user.change-password') ? 'active' : '' }}">
                                <i class="bi bi-lock"></i> Đổi mật khẩu
                            </a>
                        </li>
                        <hr class="my-2">
                        <li class="nav-item">
                            <a href="{{ route('user.logout') }}"
                               onclick="return confirm('Bạn có chắc chắn muốn thoát không?')"
                               class="nav-link text-danger d-flex align-items-center gap-2">
                                <i class="bi bi-box-arrow-right"></i> Thoát
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.delete-account') }}"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')"
                               class="nav-link text-danger d-flex align-items-center gap-2">
                                <i class="bi bi-trash"></i> Xóa tài khoản
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Nội dung bên phải --}}
            <div class="col-lg-9 col-md-8">
                <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                    @yield('content_profile')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @yield('js_profile')
@endsection
