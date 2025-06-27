<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Healing Care</title>

    <link rel="icon" href="{{ asset('user/assets/img/favicon.ico') }}?v=1" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('user/assets/img/favicon.ico') }}?v=1" type="image/x-icon">

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="care/css/bootstrap.min.css" rel="stylesheet">

    <link href="care/css/bootstrap-icons.css" rel="stylesheet">

    <link href="care/css/owl.carousel.min.css" rel="stylesheet">

    <link href="care/css/owl.theme.default.min.css" rel="stylesheet">

    <link href="care/css/templatemo-medic-care.css" rel="stylesheet">

    <link rel="stylesheet" href="/user/assets/css/font-awesome.min.css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />



</head>

<body id="top">
    <main>
        <nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">
            <div class="container">
                <a class="navbar-brand mx-auto d-lg-none" href="#hero">
                    Healing Care
                    <strong class="d-block">Health Specialist</strong>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#hero">Trang chủ</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('user.service-price')}}">Dịch Vụ</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#timeline">Quy trình</a>
                        </li>

                        <a class="navbar-brand d-none d-lg-block" href="#hero">
                            Healing Care
                            <strong class="d-block">Health Specialist</strong>
                        </a>

                        <li class="nav-item">
                            <a class="nav-link" href="#reviews">Tin tức</a>
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

        <section class="hero" id="hero">
            <div class="container">
                <div class="row">

                    <div class="col-12">
                        <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="care/images/slider/portrait-successful-mid-adult-doctor-with-crossed-arms.jpg" class="img-fluid" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img src="care/images/slider/young-asian-female-dentist-white-coat-posing-clinic-equipment.jpg" class="img-fluid" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img src="care/images/slider/doctor-s-hand-holding-stethoscope-closeup.jpg" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="heroText d-flex flex-column justify-content-center">

                            <h1 class="mt-auto mb-2">
                                Sống
                                <div class="animated-info">
                                    <span class="animated-item">khỏe</span>
                                    <span class="animated-item">vui</span>
                                    <span class="animated-item">đẹp</span>
                                </div>
                            </h1>

                            <p class="mb-4">Healing Care – Giải pháp toàn diện cho sức khỏe thể chất và tinh thần.</p>

                            <div class="heroLinks d-flex flex-wrap align-items-center">
                                <a class="custom-link me-4" href="#booking" data-hover="Đặt lịch">Đặt lịch</a>

                                <p class="contact-phone mb-0"><i class="bi-phone"></i> 012-345-6789</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="section-padding" id="about">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-12">
                        <h2 class="mb-lg-3 mb-3">Giới thiệu về Healing-Care</h2>

                        <p>Healing-Care là nơi chuyên cung cấp các dịch vụ chăm sóc sức khỏe toàn diện, từ khám chữa bệnh tổng quát đến trị liệu tâm lý và phục hồi chức năng. Với đội ngũ bác sĩ giàu kinh nghiệm, chúng tôi luôn đồng hành cùng bạn trên hành trình xây dựng một cuộc sống khỏe mạnh và hạnh phúc hơn.</p>

                        <p>Với hơn 12 năm kinh nghiệm, Healing-Care tự hào là nơi bạn có thể tin tưởng để chăm sóc sức khỏe thể chất và tinh thần một cách chuyên nghiệp và tận tâm.</p>
                    </div>

                    <div class="col-lg-4 col-md-5 col-12 mx-auto">
                        <div class="featured-circle bg-white shadow-lg d-flex justify-content-center align-items-center">
                            <p class="featured-text"><span class="featured-number">12</span> Years<br> of Experiences</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="gallery">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-6 ps-0">
                        <img src="care/images/gallery/medium-shot-man-getting-vaccine.jpg" class="img-fluid galleryImage" alt="get a vaccine" title="get a vaccine for yourself">
                    </div>

                    <div class="col-lg-6 col-6 pe-0">
                        <img src="care/images/gallery/female-doctor-with-presenting-hand-gesture.jpg" class="img-fluid galleryImage" alt="wear a mask" title="wear a mask to protect yourself">
                    </div>

                </div>
            </div>
        </section>

        <section class="section-padding pb-0" id="timeline">
            <div class="container">
                <div class="row">

                    <h2 class="text-center mb-lg-5 mb-4">Quy trình đặt lịch</h2>

                    <div class="timeline">
                        <div class="row g-0 justify-content-end justify-content-md-around align-items-start timeline-nodes">
                            <div class="col-9 col-md-5 me-md-4 me-lg-0 order-3 order-md-1 timeline-content bg-white shadow-lg">
                                <h3 class=" text-light">Đăng ký tài khoản</h3>

                                <p>Tạo tài khoản nhanh chóng chỉ với vài bước đơn giản để bắt đầu hành trình chăm sóc sức khỏe.</p>
                            </div>

                            <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                <i class="bi-patch-check-fill timeline-icon"></i>
                            </div>

                            <div class="col-9 col-md-5 ps-md-3 ps-lg-0 order-1 order-md-3 py-4 timeline-date">
                                <time>Bước 1</time>
                            </div>
                        </div>

                        <div class="row g-0 justify-content-end justify-content-md-around align-items-start timeline-nodes my-lg-5 my-4">
                            <div class="col-9 col-md-5 ms-md-4 ms-lg-0 order-3 order-md-1 timeline-content bg-white shadow-lg">
                                <h3 class=" text-light">Chọn dịch vụ khám</h3>

                                <p>Lựa chọn dịch vụ phù hợp: khám tổng quát, trị liệu tâm lý, hoặc <a href="{{route('user.service-price')}}" target="_blank" style="font-weight:bold">các gói</a> chăm sóc chuyên sâu.</p>
                            </div>

                            <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                <i class="bi-book timeline-icon"></i>
                            </div>

                            <div class="col-9 col-md-5 pe-md-3 pe-lg-0 order-1 order-md-3 py-4 timeline-date">
                                <time>Bước 2</time>
                            </div>
                        </div>

                        <div class="row g-0 justify-content-end justify-content-md-around align-items-start timeline-nodes">
                            <div class="col-9 col-md-5 me-md-4 me-lg-0 order-3 order-md-1 timeline-content bg-white shadow-lg">
                                <h3 class=" text-light">Đặt lịch hẹn</h3>

                                <p>Chọn ngày, giờ và bác sĩ phù hợp với nhu cầu của bạn. Hệ thống sẽ xác nhận nhanh chóng.</p>
                            </div>

                            <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                <i class="bi-file-medical timeline-icon"></i>
                            </div>

                            <div class="col-9 col-md-5 ps-md-3 ps-lg-0 order-1 order-md-3 py-4 timeline-date">
                                <time>Bước 3</time>
                            </div>
                        </div>

                        <div class="row g-0 justify-content-end justify-content-md-around align-items-start timeline-nodes my-lg-5 my-4">
                            <div class="col-9 col-md-5 ms-md-4 ms-lg-0 order-3 order-md-1 timeline-content bg-white shadow-lg">
                                <h3 class=" text-light">Xác nhận & chuẩn bị</h3>

                                <p class="mb-0 pb-0">Bạn sẽ nhận được thông báo xác nhận và hướng dẫn chi tiết để chuẩn bị cho buổi khám.</p>

                                <p>Chúng tôi sẽ gửi thông báo lịch hẹn cho bạn qua email bạn đã điền trong form đặt lịch.</p>
                            </div>

                            <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                <i class="bi-globe timeline-icon"></i>
                            </div>

                            <div class="col-9 col-md-5 pe-md-3 pe-lg-0 order-1 order-md-3 py-4 timeline-date">
                                <time>Bước 4</time>
                            </div>
                        </div>

                        <div class="row g-0 justify-content-end justify-content-md-around align-items-start timeline-nodes">
                            <div class="col-9 col-md-5 me-md-4 me-lg-0 order-3 order-md-1 timeline-content bg-white shadow-lg">
                                <h3 class=" text-light">Tiến hành khám</h3>

                                <p>Đến đúng giờ tại cơ sở. Trải nghiệm dịch vụ tận tâm tại Healing-Care.</p>
                            </div>

                            <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                <i class="bi-person timeline-icon"></i>
                            </div>

                            <div class="col-9 col-md-5 ps-md-3 ps-lg-0 order-1 order-md-3 py-4 timeline-date">
                                <time>Bước 5</time>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="section-padding pb-0" id="reviews">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center mb-lg-5 mb-4">Tin tức</h2>

                        <div class="owl-carousel reviews-carousel">
                            @if ($news->isNotEmpty())
                            @foreach ($news as $new)
                            <figure class="reviews-thumb d-flex flex-wrap align-items-center rounded">
                                <img src="{{ $new->thumbnail }}" class="img-fluid rounded mb-3" alt="Thumbnail" style="width: 100%; height: 220px; object-fit: cover;">

                                <figcaption class="text-start">
                                    <a href="{{ route('user.news-detail', ['slugCategory' => $new->newsCategories->first()->slug, 'slug' => $new->slug]) }}" class="text-white text-decoration-none">
                                        <p class="text-primary d-block mt-2 mb-0 w-100"><strong>{{ $new->title }}</strong></p>
                                    </a>
                                    <small class="text-muted d-block mb-0">{{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y') }}</small>
                                    <p class="reviews-text w-150">{!! Str::limit(strip_tags($new->content), 100, '...') !!}</p>
                                </figcaption>
                            </figure>

                            @endforeach
                            @else
                            <p class="text-center">Hiện chưa có tin tức.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="section-padding" id="booking">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-12 mx-auto">
                        <div class="booking-form">
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <h2 class="text-center mb-lg-3 mb-2">Đặt lịch</h2>

                            <form class="form" id="book-appointment-form" action="{{ route('user.book-appointment') }}" method="POST">
                                @csrf
                                <div class="row g-3">

                                    <div class="col-lg-6 col-12">
                                        <input type="text" name="name" class="form-control" placeholder="Họ tên" required>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" required>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <input type="text" id="dob_fake" class="form-control" placeholder="Ngày sinh" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}" name="dob">
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <select name="gender" class="form-control">
                                            <option value="">Chọn giới tính</option>
                                            <option value="1">Nam</option>
                                            <option value="2">Nữ</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <select name="department_id" class="form-control">
                                            <option value="">Chọn chuyên khoa</option>
                                            @if ($departments)
                                            @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                @if (isset($selectedDepartmentId) && $selectedDepartmentId==$department->id) selected @endif>
                                                {{ $department->name }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <select name="doctor_id" class="form-control" id="doctor_id">
                                            <option value="">Chọn bác sĩ</option>
                                            @if ($doctors)
                                            @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}"
                                                @if (isset($selectedDoctor) && $selectedDoctor->id == $doctor->id) selected @endif>
                                                {{ $doctor->name }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <input type="text" id="appointment_date" name="appointment_date" class="form-control" placeholder="Ngày khám" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}" name="dob">
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <select name="session" class="form-control" id="time_period_select" required>
                                            <option value="">Chọn buổi khám</option>
                                            <option value="morning">Buổi sáng</option>
                                            <option value="afternoon">Buổi chiều</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <textarea name="note" rows="4" class="form-control" placeholder="Ghi chú"></textarea>
                                    </div>

                                    <div class="col-12 d-flex align-items-center gap-3 mt-4">
                                        <button type="submit" class="custom-link" style="border:none; background:black; color:white; padding:10px 20px; " data-hover="GỬI YÊU CẦU">
                                            GỬI YÊU CẦU
                                        </button>

                                        <span class="text-muted small m-0" style="line-height: 1;">
                                            (Chúng tôi sẽ xác nhận bằng tin nhắn của bạn)
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>


    </main>

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
                    <h5 class="mb-lg-4 mb-3">Healing Care</h5>

                    <p><a href="mailto:hello@company.co">healingcare.vn@gmail.com</a>
                    <p>

                    <p>184 Đ.Lê Đại Hành, Phường 15, Quận 11, Hồ Chí Minh</p>
                </div>

                <div class="col-lg-3 col-md-6 col-12 ms-auto">
                    <h5 class="mb-lg-4 mb-3">Kết nối với chúng tôi </h5>

                    <ul class="social-icon">
                        <li><a href="#" class="social-icon-link bi-facebook"></a></li>

                        <li><a href="#" class="social-icon-link bi-twitter"></a></li>

                        <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                        <li><a href="#" class="social-icon-link bi-youtube"></a></li>
                    </ul>
                </div>



            </div>
            </section>
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script src="user/assets/js/custom/book-appointment.js"></script>
    <script src="care/js/jquery.min.js"></script>
    <script src="care/js/bootstrap.bundle.min.js"></script>
    <script src="care/js/owl.carousel.min.js"></script>
    <script src="care/js/scrollspy.min.js"></script>
    <script src="care/js/custom.js"></script>
    <script src="/user/assets/js/jquery.min.js"></script>

    <!-- Toastr notifications -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        @if(session('success'))
        toastr.success("{{ session('success') }}", "Thành công");
        @elseif(session('error'))
        toastr.error("{{ session('error') }}", "Lỗi");
        @endif
    </script>
</body>

</html>