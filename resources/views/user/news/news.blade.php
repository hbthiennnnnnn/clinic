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
<div class="row mb-4">
    <div class="col-lg-12 text-center">
        <div class="section-title">
            <img src="/user/assets/img/section-img.png" alt="icon" />
            <p class="mt-3">
                Theo dõi tin tức y tế mới nhất từ chúng tôi để luôn cập nhật thông tin sức khỏe quan trọng
            </p>
        </div>
    </div>
</div>
@section('content')
<section class="blog py-5">
    <div class="container">
        <div class="row mb-4">

            @if ($news->isNotEmpty())
            <div class="row">
                @foreach ($news as $new)
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden" style="min-height: 100%">
                        <div class="ratio ratio-16x9">
                     <img src="{{ asset($new->thumbnail) }}" class="card-img-top object-fit-cover" alt="thumbnail">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="text-muted small mb-2">
                                {{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y') }}
                            </div>
                            <h5 class="card-title">
                                <a href="{{ route('user.news-detail', ['slugCategory' => $category->slug, 'slug' => $new->slug]) }}"
                                    class="text-dark text-decoration-none">
                                    {{ Str::words($new->title, 12, '...') }}
                                </a>
                            </h5>
                            <p class="card-text flex-grow-1">
                                {!! Str::limit(strip_tags($new->content), 100, '...') !!}
                            </p>

                        </div>
                    </div>
                </div>

                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $news->links() }}
            </div>
            @else
            <div class="w-100 text-center text-danger">
                <p>Danh mục này chưa có tin tức nào</p>
            </div>
            @endif
        </div>
</section>
@endsection