@extends('user.auth.layout_profile') 
@section('content')
<div class="container text-center mt-5">
    <h2>Thanh toán dịch vụ khám thành công!</h2>
    <p>Giấy khám bệnh <strong>#{{ $medical->medical_certificate_code }}</strong> đã được thanh toán.</p>
    <a href="{{ route('user.medical-history') }}" class="btn btn-primary mt-3">Quay lại lịch sử khám</a>
</div>
@endsection