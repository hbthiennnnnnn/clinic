@extends('user.auth.layout_profile') 
@section('content')
    <div class="container text-center mt-5">
        <h2>Thanh toán thất bại!!!</h2>
        <p>Vui lòng kiểm tra lại tài khoản của mình hoặc thực hiện lại thanh toán!!!</p>

        <a href="{{ route('user.payment-history') }}" class="btn btn-primary mt-3">Quay lại</a>
    </div>
@endsection