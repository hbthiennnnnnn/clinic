@extends('user.auth.layout_profile')

@section('content_profile')
<div class="container px-0">
    <h4 class="mb-4 d-flex align-items-center">
        <i class="bi bi-credit-card-fill me-2 text-primary"></i> Lịch sử thanh toán
    </h4>

    <div class="table-responsive">
        <table class="table table-hover table-borderless align-middle shadow-sm rounded-3 overflow-hidden">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Loại</th>
                    <th scope="col">Mã đơn</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Số tiền</th>
                    <th scope="col">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @php $index = 1; @endphp

                {{-- Đơn thuốc --}}
                @foreach($prescriptions as $p)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>Đơn thuốc</td>
                    <td class="fw-medium text-primary">{{ $p->prescription_code }}</td>
                    <td>{{ $p->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($p->total_payment) }} <span class="text-muted">VND</span></td>
                    <td>
                        @if($p->status == 1)
                        <span class="badge bg-success px-3 py-2"><i class="bi bi-check-circle me-1"></i> Đã thanh toán</span>
                        @else
                        <span class="badge bg-secondary px-3 py-2"><i class="bi bi-clock me-1"></i> Chưa thanh toán</span>
                        @endif
                    </td>

                </tr>
                @endforeach

                {{-- Dịch vụ khám --}}
                @foreach($services as $s)
                @php
                $total = 0;
                foreach ($s->services as $sv) {
                $price = $sv->price;
                if ($s->insurance) $price *= 0.8;
                $total += $price;
                }
                @endphp
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>Dịch vụ khám</td>
                    <td class="fw-medium text-primary">{{ $s->medical_certificate_code }}</td>
                    <td>{{ \Carbon\Carbon::parse($s->created_at)->format('d/m/Y') }}</td>
                    <td>{{ number_format($total) }} <span class="text-muted">VND</span></td>
                    <td>
                        @if($s->payment_status == 1)
                        <span class="badge bg-success px-3 py-2"><i class="bi bi-check-circle me-1"></i> Đã thanh toán</span>
                        @else
                        <span class="badge bg-secondary px-3 py-2"><i class="bi bi-clock me-1"></i> Chưa thanh toán</span>
                        @endif
                    </td>

                </tr>
                @endforeach

                @if($index == 1)
                <tr>
                    <td colspan="6" class="text-center text-muted">Không có dữ liệu thanh toán.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection