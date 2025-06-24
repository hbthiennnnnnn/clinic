@extends('user.auth.layout_profile') 
@section('content')
    <div class="container text-center mt-5">
        <h2>Thanh toán thành công!</h2>
        <p>Đơn thuốc của bạn đã được thanh toán thành công.</p>

        <a href="{{ route('user.payment-history') }}" class="btn btn-primary mt-3">Quay lại</a>
    </div>
@endsection