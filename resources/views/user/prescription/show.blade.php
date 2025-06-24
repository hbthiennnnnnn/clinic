@extends('user.auth.layout_profile')

@section('content_profile')
<div class="container">
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h4>🧾 Chi tiết đơn thuốc #{{ $prescription->prescription_code }}</h4>
        </div>

        <div class="card-body">
            <p><strong>Bệnh nhân:</strong> {{ $prescription->medical_certificate->patient->name }}</p>
            <p><strong>Ngày tạo:</strong> {{ $prescription->created_at->format('d/m/Y') }}</p>
            <p><strong>Ghi chú:</strong> {{ $prescription->note ?? 'Không có' }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($prescription->total_payment) }} VND</p>

            <h5 class="mt-4">Danh sách thuốc</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên thuốc</th>
                            <th>Đơn vị</th>
                            <th>Số lượng</th>
                            <th>Liều dùng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($prescription->medicines as $pm)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pm->name }}</td>
                            <td>{{ $pm->unit }}</td>
                            <td>{{ $pm->pivot->quantity }}</td>
                            <td>{{ $pm->pivot->dosage }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Không có thuốc nào trong đơn.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('user.medical-history') }}" class="btn btn-secondary mt-3">Quay lại</a>
        </div>
    </div>
</div>
@endsection
