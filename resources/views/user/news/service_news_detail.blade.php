@extends('user.layout.news')
@section('breadcrumb')
<div class="breadcrumbs overlay banner-bread">
    <div class="container text-center">
        <div class="bread-inner py-4">
            <h2 class="text-black mb-2">Chi tiết bài viết</h2>
            <p style="list-style: none; color: #000;">
                <a href="/" style="color: #000;">Trang chủ</a>
                <i class="icofont-simple-right"></i>
                <span>{{ $title }}</span>
            </p>
        </div>
    </div>
</div>
@endsection

<section class="news-single section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="row">
                    @section('content')
                    <div class="col-12">
                        <div class="single-main">
                            <div class="news-head">
                                
                                {!! $blog->content !!}
                            </div>
                        </div>
                        <div data-href="https://developers.facebook.com/docs/plugins/" data-width=""
                            data-layout="" data-action="" data-size="" data-share="true"></div>
                        <div data-href="{{ \URL::current() }}" data-width="100%" data-numposts="10">
                        </div>
                    </div>
                    @endsection
                </div>
            </div>
            @section('sidebar')

            <div class="main-sidebar">
                <div class="single-widget category">
                    <h3 class="title">Danh mục tin tức</h3>
                    <ul class="categor-list">
                        @foreach ($categories as $cate)
                        <li><a href="{{ route('user.news', $cate->slug) }}">{{ $cate->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="single-widget recent-post">
                    <h3 class="title">Tin tức liên quan</h3>
                    @foreach ($relatedNews as $blog)
                    <div class="single-post d-flex mb-3" style="gap: 10px;">
                        <div class="image" style="flex-shrink: 0; width: 80px; height: 60px; overflow: hidden; border-radius: 6px;">
                           <img src="{{ asset($blog->thumbnail) }}" alt="thumb" style="width: 100%; height: 100%; object-fit: cover;" />
                        </div>
                        <div class="content">
                            <h5 style="font-size: 14px; margin: 0 0 5px;">
                                <a href="{{ route('user.news-detail', ['slugCategory' => $category->slug, 'slug' => $blog->slug]) }}"
                                    style="text-decoration: none; color: #333;">
                                    {{ Str::words($blog->title, 10, '...') }}
                                </a>
                            </h5>
                            <ul class="comment list-unstyled mb-0" style="font-size: 12px; color: #777;">
                                <li>
                                    <i class="fa fa-calendar me-1"></i>
                                    {{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

            @endsection
        </div>
    </div>
</section>


@section('js')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v22.0">
</script>
@endsection