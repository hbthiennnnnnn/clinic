<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <title>Healing Care</title>
    <link rel="icon" href="{{ asset('user/assets/img/favicon.ico') }}?v=1" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('user/assets/img/favicon.ico') }}?v=1" type="image/x-icon">

    <meta name="author" content="">

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('care/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('care/css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('care/css/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset('care/css/owl.theme.default.min.css') }}" rel="stylesheet">

    <link href="{{ asset('care/css/templatemo-medic-care.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="/user/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/user/assets/css/icofont.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">



</head>

<body id="top">
    {{-- Navbar giữ nguyên --}}
    <nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">

        <div class="container">
            <a class="navbar-brand mx-auto d-lg-none" href="http://healingcare.healingdc.id.vn/">
                Healing Care
                <strong class="d-block">Health Specialist</strong>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="http://healingcare.healingdc.id.vn/">Trang chủ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.service-price')}}">Dịch vụ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#timeline">Quy trình</a>
                    </li>

                    <a class="navbar-brand d-none d-lg-block" href="http://healingcare.healingdc.id.vn/">
                        Healing Care
                        <strong class="d-block">Health Specialist</strong>
                    </a>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#reviews">Tin tức</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#booking">Đặt lịch</a>
                    </li>

                    <li class="nav-item">

                        @if (Auth::check())
                    <li>
                        <a class="nav-link" href="{{ route('user.overview') }}"><i
                                class="fa fa-user 
                                    mr-1"></i>{{ Auth::user()->name }}</a>
                    </li>
                    @else
                    <li>
                        <a class="nav-link" href="{{route('user.login')}}">Đăng nhập</a>
                    </li>
                    @endif

                    </li>
                </ul>
            </div>

        </div>
    </nav>

    {{-- Đây là phần nội dung động sẽ thay đổi tuỳ trang --}}
    <main class="d-flex align-items-center justify-content-center" style="min-height: 70vh">
        @yield('content')
    </main>


    {{-- Footer giữ nguyên --}}
   <footer class="site-footer section-padding" id="contact">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 me-auto col-12">
                    <h5 class="mb-lg-4 mb-3">Giờ hoạt động</h5>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex">
                            Thứ 7 - Chủ nhật:
                            <span>Nghỉ</span>
                        </li>

                        <li class="list-group-item d-flex">
                            Thứ 2 – Thứ 6:
                            <span>7:00 - 17:00</span>
                        </li>


                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 col-12 my-4 my-lg-0">
                    <h5 class="mb-lg-4 mb-3">Chính sách</h5>
                    
                    <div class="mt-3">
                        <a href="http://online.gov.vn/" target="_blank" rel="noopener noreferrer">
                            <img src="https://umcclinic.com.vn/Data/Sites/1/media/img/verify.png"
                                alt="Bộ Công Thương"
                                width="100%"
                                style="display: block; margin-bottom: 6px;">
                        </a>
                        <small style="font-size: 12px; color: #666; font-style: italic;">
                            Đây là sản phẩm demo. Nếu triển khai chính thức, cần đăng ký với Bộ Công Thương.
                        </small>
                    </div>


                </div>

                <div class="col-lg-3 col-md-6 col-12 ms-auto">
                    <h5 class="mb-lg-4 mb-3">Liên Kết </h5>

                    <ul class="social-icon">
                        <li style="margin-bottom: 12px; font-size: 18px;">
                            <img src="https://umcclinic.com.vn/Data/Sites/1/skins/default/img/logo-3.png" alt="icon" width="16" height="16" style="vertical-align: middle; margin-right: 8px;">
                            <a href="http://www.medinet.hochiminhcity.gov.vn/Default.aspx">
                                Cổng điện tử Sở Y tế TP. HCM
                            </a>
                        </li>
                        <li style="margin-bottom: 12px; font-size: 18px;">
                            <img src="https://umcclinic.com.vn/Data/Sites/1/skins/default/img/logo-3.png" alt="icon" width="16" height="16" style="vertical-align: middle; margin-right: 8px;">
                            <a href="http://www.medinet.hochiminhcity.gov.vn/thong-bao-tb1013.aspx/Default.aspx">
                                Thông báo Sở Y tế TP. HCM
                            </a>
                        </li>
                    </ul>


                    <div class="mt-3">
                        <iframe
                            src="https://www.google.com/maps?q=184+Lê+Đại+Hành,+Phường+15,+Quận+11,+TP.HCM&output=embed"
                            style="width: 100%; height: 200px; border: 0; border-radius: 8px;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                </div>



            </div>
            </section>
    </footer>
    @include('user.layout.script')
    @yield('js')
    {{-- Script giữ nguyên --}}
    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset('user/assets/js/custom/book-appointment.js') }}"></script>

    @include('user.layout.script')
    <script src="{{ asset('care/js/jquery.min.js') }}"></script>
    <script src="{{ asset('care/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('care/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('care/js/scrollspy.min.js') }}"></script>
    <script src="{{ asset('care/js/custom.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
            toastr.success("{{ session('success') }}", "Thành công");
            @endif

            @if(session('error'))
            toastr.error("{{ session('error') }}", "Lỗi");
            @endif
        });
    </script>


</body>

</html>