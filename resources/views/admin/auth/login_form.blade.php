<!doctype html>
<html lang="en">

<head>
    @include('admin.layout_admin.headonly')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-6 col-lg-4 col-sm-8">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center py-3 w-100">
                                    <h3 class="fw-bold text-primary m-0">HEALING CARE</h3>
                                </div>

                                <form method="POST" action="/admin/login" id="login">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            aria-describedby="emailHelp" value="{{ old('email') }}">
                                        @error('email')
                                        <div class="message-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Mật khẩu <span
                                                class="text-danger">*</span></label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" value="{{ old('password') }}">
                                        @error('password')
                                        <div class="message-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value=""
                                                id="flexCheckChecked" name="remember" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Ghi nhớ đăng nhập
                                            </label>
                                        </div>
                                        <a class="text-primary fw-bold" href="{{ route('admin.forgotpassword') }}">Quên
                                            mật khẩu?</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 mb-4 text-uppercase">Đăng
                                        nhập quản
                                        trị</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layout_admin.script')
</body>

</html>