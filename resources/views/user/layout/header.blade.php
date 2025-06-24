<header class="header">
    <link rel="icon" href="{{ asset('user/assets/img/favicon.ico') }}?v=1" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('user/assets/img/favicon.ico') }}?v=1" type="image/x-icon">
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7 col-12">
                    <ul class="top-contact">
                        <li><i class="fa fa-phone"></i>0123.456.789</li>
                        <li>
                            <i class="fa fa-envelope"></i><a href="mailto:info@unicaremedic.vn">info@unicaremedic.vn
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-5 col-12">
                    <ul class="top-link">
                        <li class="search-wrapper">
                            <button id="toggle-search" class="search-btn">
                                <i class="fa fa-search"></i>
                            </button>
                            <form action="{{ route('user.search') }}" method="GET">
                                <div id="search-box" class="search-box">
                                    <input type="text" placeholder="Tìm kiếm..." name="q"
                                        value="{{ request('q') }}" required />
                                    <button class="search-submit" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                        <li>
                            <i class="fa fa-envelope mr-1"></i><a href="mailto:support@yourmail.com">Vi</a>
                        </li>
                        @if (Auth::check())
                            <li>
                                <a href="{{ route('user.overview') }}"><i
                                        class="fa fa-user
                                    mr-1"></i>{{ Auth::user()->name }}</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('user.login') }}">Đăng nhập</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-inner">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="logo">
                            <!-- <a href="/"><img src="/user/assets/img/logocustom.png" alt="#" /></a> -->
                            <a href="/"><b style="font-size: 20px;">HEALING CARE</b></a>    
                        </div>
                        <div class="mobile-nav"></div>
                    </div>
                    <div class="col-lg-7 col-md-9 col-12">
                        <div class="main-menu">
                            <nav class="navigation">
                                <ul class="nav menu">
                                    @foreach ($menuItems as $menu)
                                        @php
                                            $isActive =
                                                request()->is(ltrim($menu->url, '/')) ||
                                                $menu->children->contains(function ($child) {
                                                    return request()->is(ltrim($child->url, '/'));
                                                });
                                        @endphp
                                        <li class="{{ $isActive ? 'active' : '' }}">
                                            <a href="{{ $menu->url ?? '#' }}">
                                                {{ $menu->title }}
                                                @if ($menu->children->isNotEmpty())
                                                    <i class="icofont-rounded-down"></i>
                                                @endif
                                            </a>

                                            @if ($menu->children->isNotEmpty())
                                                <ul class="dropdown">
                                                    @foreach ($menu->children as $child)
                                                        <li><a href="{{ $child->url }}">{{ $child->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach

                                </ul>
                                {{-- <ul class="nav menu">
                                    <li class="active">
                                        <a href="#">Trang chủ <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="/">Lịch sử hình thành và phát triển</a></li>
                                            <li><a href="{{ route('user.doctors') }}">Đội ngũ chuyên gia</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Dịch vụ <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="{{ route('user.book-appointment-page') }}">Đặt lịch khám</a>
                                            </li>
                                            <li><a href="{{ route('user.news', 'dich-vu-y-te') }}">Dịch vụ y tế</a></li>
                                            <li><a href="/">Hỏi đáp</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Chương trình ưu đãi </a></li>
                                    <li>
                                        <a href="#">Tin tức <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="{{ route('user.news', 'tin-tuc-y-hoc') }}">Tin tức y học</a>
                                            </li>
                                            <li><a href="{{ route('user.news', 'tin-tuc-phong-kham') }}">Tin tức phòng
                                                    khám</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('user.contact') }}">Liên hệ</a></li>
                                </ul> --}}
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-2 col-12">
                        <div class="get-quote">
                            <a href="{{ route('user.book-appointment-page') }}" class="btn">ĐẶT LỊCH</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
