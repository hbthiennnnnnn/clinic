@extends('admin.layout_admin.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin-assets/css/custom/listmodule.css') }}">
@endsection
@section('content')
    @php
        $filters = [];
        if (request()->filled('q')) {
            $filters[] = 'Từ khóa: <strong>' . e(request('q')) . '</strong>';
        }
        if (request()->filled('status')) {
            $statuses = ['0' => 'Tạm ngưng', '1' => 'Hoạt động'];
            $filters[] = 'Trạng thái: <strong>' . ($statuses[request('status')] ?? 'Không rõ') . '</strong>';
        }
    @endphp
    <div class="container">
        <div class="d-flex justify-content-between align-items-center m-4">
            <div class="text-uppercase fw-bold">
                @if (count($filters))
                    Tìm kiếm phòng khám
                @else
                    Danh sách phòng khám
                @endif
            </div>
            <div class="fw-bold text-capitalize">
                <a href="{{ route('admin.dashboard') }}">Quản lý</a> / <a href="{{ route('clinic.index') }}">Quản
                    lý phòng khám</a>
            </div>
        </div>
        <div class="card shadow-sm m-4">
            <div class="card-header">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <div class="search-container" title="Tìm kiếm phòng khám">
                        <form action="{{ route('admin.search', ['type' => 'clinic']) }}" method="GET">
                            <input type="text" placeholder="Từ khóa" name="q" value="{{ request('q') }}"
                                title="Tìm kiếm phòng khám">
                            <select name="status" title="Tìm kiếm theo trạng thái">
                                <option value="">Trạng thái</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Tạm ngưng
                                </option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Hoạt động
                                </option>
                            </select>
                            <button type="submit"><i class="fas fa-search search-icon"></i></button>
                        </form>
                    </div>
             
                        <div class="d-flex justify-content-end my-2 align-items-center">
                            <a href="{{ route('clinics.export') }}"
                                class="btn btn-label-success btn-round btn-sm me-2">Excel</a>
                            <a href="{{ route('clinic.create') }}" class="btn btn-secondary"><i class="fas fa-plus me-1"></i>
                                Thêm phòng khám</a>
                        </div>
                  
                </div>
            </div>
            <div class="card-body">
                @if (count($filters))
                    <p class="alert alert-info">
                        Kết quả tìm kiếm: {!! implode(', ', $filters) !!}
                    </p>
                @endif
                @if ($clinics->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã</th>
                                    <th scope="col">Tên phòng khám</th>
                                    <th scope="col">Chuyên khoa</th>
                                    <th scope="col">Trạng thái</th>
                                    @can(['chinh-sua-quyen', 'xoa-quyen'])
                                        <th scope="col">Xử lý</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clinics as $key => $clinic)
                                    <tr>
                                        <td>{{ $clinics->firstItem() + $key }}</td>
                                        <td>{{ $clinic->clinic_code }}</td>
                                        <td>{{ $clinic->name }}</td>
                                        <td><span class="badge badge-info">{{ $clinic->department->name }}</span></td>
                                        <td>
                                            {!! $clinic->status == 1
                                                ? '<span class="badge badge-success">Hoạt động</span>'
                                                : '<span class="badge badge-warning">Tạm ngưng</span>' !!}
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                @can('chinh-sua-quyen')
                                                    <a href="{{ route('clinic.edit', $clinic->id) }}"
                                                        class="btn btn-outline-primary btn-xs me-2" title="Edit"><i
                                                            class="fas fa-edit" title="Chỉnh sửa phòng khám"
                                                            data-bs-toggle="tooltip"></i></a>
                                                @endcan
                                                @can('xoa-quyen')
                                                    <form action="{{ route('clinic.destroy', $clinic->id) }}" method="POST"
                                                        class="delete-form">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" title="Delete"
                                                            class="btn btn-outline-danger btn-xs delete-btn"><i
                                                                class="fas fa-trash" data-bs-toggle="tooltip"
                                                                title="Xóa phòng khám"></i></button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="alert alert-danger">Chưa có phòng khám nào!</p>
                @endif
            </div>

            <div class="d-flex justify-content-center ">
                {{ $clinics->links() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin-assets/js/custom/deleteSweetaler.js') }}"></script>
@endsection
