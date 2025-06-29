@extends('user.auth.layout_profile')
@section('content_profile')
<div class="container" style="color: white">
    <div class="card shadow-sm m-4">
        <div class="card-header bg-primary text-white">
            <h4>📄 Chi tiết Giấy khám bệnh #{{ $medical_certificate->medical_certificate_code }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Bệnh nhân</h5>
                    <p><strong>Họ tên:</strong> {{ $medical_certificate->patient->name }}</p>
                    <p><strong>Ngày sinh:</strong> {{ $medical_certificate->patient->dob }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Bác sĩ</h5>
                    @if ($medical_certificate->doctor_id)
                    <p><strong>Họ tên:</strong> {{ $medical_certificate->doctor->name }}</p>
                    <p><strong>Email:</strong> {{ $medical_certificate->doctor->email }}</p>
                    @else
                    <p><em>Chưa có bác sĩ</em></p>
                    @endif
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <h5>Trạng thái khám</h5>
                    @if ($medical_certificate->medical_status == 2)
                    <span class="badge bg-success">Đã khám</span>
                    @elseif($medical_certificate->medical_status == 1)
                    <span class="badge bg-primary">Đang khám</span>
                    @else
                    <span class="badge bg-warning">Chưa khám</span>
                    @endif
                </div>

                <div class="col-md-6">
                    <h5>Trạng thái thanh toán</h5>
                    @if ($medical_certificate->payment_status == 1)
                    <span class="badge bg-success">Đã thanh toán</span>
                    @elseif($medical_certificate->payment_status == 2)
                    <span class="badge bg-warning">Đã tạm ứng</span>
                    @else
                    <span class="badge bg-danger">Chưa thanh toán</span>
                    @endif
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <h5>Triệu chứng</h5>
                    <p>{{ $medical_certificate->symptom }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Chẩn đoán</h5>
                    <p>{!! $medical_certificate->diagnosis !!}</p>
                </div>
            </div>

            @php $total_service_price = 0; @endphp
            <div class="row mt-3">
                <div class="col-md-6 border p-3 rounded">
                    <h5>Dịch vụ khám</h5>
                    @if ($medical_certificate->services && $medical_certificate->services->isNotEmpty())
                    @foreach ($medical_certificate->services as $service)
                    @php
                    $price = $service->price;
                    if ($medical_certificate->insurance) {
                    $price *= 0.8;
                    }
                    $total_service_price += $price;
                    @endphp
                    <p>
                        {{ $service->name }} -
                        {{ $medical_certificate->insurance ? 'Giá BHYT: ' : 'Giá: ' }}
                        {{ number_format($price) }} VND
                    </p>
                    @endforeach
                    <p><strong>Tổng tiền dịch vụ: {{ number_format($total_service_price) }} VND</strong></p>

                    @if ($medical_certificate->payment_status != 1)
                    <a href="{{ route('user.service.checkout', ['id' => $medical_certificate->id]) }}" class="btn btn-success mt-2">
                        <i class="bi bi-credit-card"></i> Thanh toán dịch vụ khám
                    </a>
                    @endif
                    @else
                    <p><em>Không có dịch vụ khám</em></p>
                    @endif
                </div>

                <div class="col-md-6 border p-3 rounded">
                    @if (isset($prescription))
                    <h5>Đơn thuốc</h5>
                    <p><strong>Mã đơn:</strong> {{ $prescription->prescription_code }}</p>
                    <p><strong>Số tiền:</strong> {{ number_format($prescription->total_payment) }} VND</p>

                    <div class="d-flex gap-2 mt-2 flex-wrap">
                        <a href="{{ route('user.prescription.show', ['id' => $prescription->id]) }}" class="btn btn-info">
                            <i class="bi bi-eye-fill"></i> Xem chi tiết đơn thuốc
                        </a>
                        @if ($prescription->status != 1)
                        <a href="{{ route('stripe.checkout', ['id' => $prescription->id]) }}" class="btn btn-primary">
                            Thanh toán đơn thuốc
                        </a>
                        @endif
                    </div>
                    @else
                    <p><em>Không có đơn thuốc</em></p>
                    @endif
                </div>
            </div>


            <div class="mt-3">
                <h5>Kết luận</h5>
                <p>{!! $medical_certificate->conclude !!}</p>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <h5>Ngày khám</h5>
                    <p>{{ \Carbon\Carbon::parse($medical_certificate->medical_time)->format('H:i d/m/Y') }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Ngày xuất viện</h5>
                    <p>{{ $medical_certificate->discharge_date ? \Carbon\Carbon::parse($medical_certificate->discharge_date)->format('d/m/Y') : 'Chưa có' }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Ngày tái khám</h5>
                    <p>{{ $medical_certificate->re_examination_date ? \Carbon\Carbon::parse($medical_certificate->re_examination_date)->format('d/m/Y') : 'Chưa có' }}</p>
                </div>
            </div>

            @if ($medical_certificate->result_file)
            <div class="mt-4">
                <h5>📂 File kết quả</h5>
                <a href="{{ asset($medical_certificate->result_file) }}" target="_blank" class="btn btn-info">
                    <i class="fas fa-file-download"></i> Xem file
                </a>
            </div>
            @endif

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('user.medical-history') }}" class="btn btn-secondary">
                    Quay lại
                </a>

                @if ($medical_certificate->payment_status != 1 || (isset($prescription) && $prescription->status != 1))
                <a href="{{ route('user.prescription_and_service.checkout', ['id' => $medical_certificate->id]) }}"
                    class="btn btn-warning">
                    <i class="bi bi-wallet2"></i> Thanh toán tất cả
                </a>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection