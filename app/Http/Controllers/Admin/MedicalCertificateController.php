<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MedicalCertificateExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ConcludeRequest;
use App\Http\Requests\Admin\MedicalCertificateRequest;
use App\Http\Requests\Admin\ServiceExamRequest;
use App\Models\Admin;
use App\Models\Clinic;
use App\Models\Department;
use App\Models\MedicalCertificate;
use App\Models\MedicalService;
use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class MedicalCertificateController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('xem-danh-sach-giay-kham-benh');
        $medical_certificates = MedicalCertificate::orderByDesc('id')->with('patient', 'doctor', 'clinic')->paginate(15);
        $title = 'Danh sách giấy khám bệnh';
        return view('admin.medical-certificate.list', compact('title', 'medical_certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('them-giay-kham-benh');
        $title = 'Thêm giấy khám bệnh';
        $patients = Patient::orderByDesc('id')->get();
        $clinics = Clinic::with('department')->get();


        return view('admin.medical-certificate.create', compact('title', 'patients', 'clinics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicalCertificateRequest $request)
    {
        $this->authorize('them-giay-kham-benh');
        try {
            $med = MedicalCertificate::create([
                'patient_id' => $request->patient_id,
                'clinic_id' => $request->clinic_id,
            ]);
            if ($request->insurance) {
                $med->update(['insurance' => true]);
            }
            Session::flash('success', 'Tạo giấy khám bệnh thành công');
            return redirect()->route('medical-certificate.index');
        } catch (\Exception $e) {
            dd($e);
            Session::flash('error', 'Có lỗi khi tạo');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $medical_certificate = MedicalCertificate::findOrFail($id);
        $title = 'Chi tiết giấy khám bệnh';
        return view('admin.medical-certificate.show', compact('title', 'medical_certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $this->authorize('chinh-sua-giay-kham-benh');
        $medical_certificate = MedicalCertificate::findOrFail($id);
        $patients = Patient::orderByDesc('id')->get();
        $clinics = Clinic::where('status', 1)->orderByDesc('id')->get();
        $title = 'Chỉnh sửa giấy khám bệnh';
        return view('admin.medical-certificate.edit', compact('title', 'patients', 'clinics', 'medical_certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicalCertificateRequest $request, string $id)
    {
        $this->authorize('chinh-sua-giay-kham-benh');
        $medical_certificate = MedicalCertificate::findOrFail($id);
        try {
            $medical_certificate->update([
                'patient_id' => $request->patient_id,
                'clinic_id' => $request->clinic_id
            ]);
            if ($request->insurance) {
                $medical_certificate->update(['insurance' => true]);
            }
            Session::flash('success', 'Cập nhật giấy khám bệnh thành công');
            return redirect()->route('medical-certificate.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Có lỗi khi chỉnh sửa');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('xoa-giay-kham-benh');
        $medical_certificate = MedicalCertificate::findOrFail($id);
        try {
            $medical_certificate->delete();
            return response()->json(['success' => true, 'message' => 'Xóa giấy khám bệnh thành công.']);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = ($e->getCode() == 23000)
                ? 'Không thể xóa giấy khám bệnh vì có dữ liệu liên quan.'
                : 'Có lỗi khi xóa giấy khám bệnh: ' . $e->getMessage();
            return  response()->json(['success' => false, 'message' => $message]);
        }
    }

    public function service($id)
    {
        $medicalCertificate = MedicalCertificate::with('services')->find($id);

        if ($medicalCertificate->medical_status == 2) {
            Session::flash('error', 'Giấy khám bệnh đã khám hoàn tất');
            return redirect()->back();
        }
        $title = 'Khám dịch vụ';
        $patients = Patient::orderByDesc('id')->get();
        $clinics = Clinic::where('status', 1)->orderByDesc('id')->get();
        $doctors = Admin::role('admin')->where('status', 1)->get();
        $medical_services = MedicalService::where('status', 1)->orderByDesc('id')->get();
        return view('admin.medical-certificate.service', compact('title', 'medicalCertificate', 'patients', 'clinics', 'medical_services', 'doctors'));
    }

    public function getClinicsByService(Request $request)
    {
        $clinics = Clinic::whereHas('medical_services', function ($query) use ($request) {
            $query->where('medical_services.id', $request->service_id);
            $query->where('status', 1);
        })->get();

        return response()->json($clinics);
    }

    public function getDoctorsByClinic(Request $request)
    {
        $clinicId = $request->clinic_id;
        $doctors = Admin::where('status', 1)->where('clinic_id', $clinicId)->get();

        return response()->json($doctors);
    }



    public function service_exam(ServiceExamRequest $request, $id)
    {
        $medical_certificate = MedicalCertificate::findOrFail($id);

        try {
            // Cập nhật thông tin giấy khám
            $medical_certificate->update([
                'patient_id' => $request->patient_id,
                'insurance' => $request->has('insurance'),
                'symptom' => $request->symptom,
                'diagnosis' => $request->diagnosis,
                'medical_status' => 1
            ]);

            if ($request->has('services') && is_array($request->services)) {
                $medical_certificate->services()->detach();

                foreach ($request->services as $service) {
                    if (
                        isset($service['medical_service_id']) &&
                        isset($service['clinic_id']) &&
                        isset($service['doctor_id']) &&
                        isset($service['medical_time'])
                    ) {
                        $medical_certificate->services()->attach(
                            $service['medical_service_id'],
                            [
                                'clinic_id' => $service['clinic_id'],
                                'doctor_id' => $service['doctor_id'],
                                'medical_time' => $service['medical_time'],
                                'note' => $service['note'] ?? null,
                            ]
                        );
                    }
                }
            }



            Session::flash('success', 'Thêm dịch vụ khám thành công');
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lưu thất bại: ' . $e->getMessage()
            ]);
        }
    }

    public function conclude($id)
    {
        $medical_certificate = MedicalCertificate::findOrFail($id);
        $title = 'Kết luận khám';
        $patients = Patient::orderByDesc('id')->get();
        $clinics = Clinic::where('status', 1)->orderByDesc('id')->get();
        $medical_services = MedicalService::where('status', 1)->orderByDesc('id')->get();
        return view('admin.medical-certificate.conclude', compact('title', 'medical_certificate', 'patients', 'clinics', 'medical_services'));
    }

public function conclude_handle(ConcludeRequest $request, $id)
{
    $medical_certificate = MedicalCertificate::with(['services'])->findOrFail($id);

    try {
        // Check bác sĩ hiện tại có quyền kết luận hay không (nếu là người phụ trách ít nhất một dịch vụ trong đơn này)
        $adminId = auth()->guard('admin')->id();
        $isAuthorized = $medical_certificate->services->contains(function ($service) use ($adminId) {
            return $service->pivot->doctor_id == $adminId;
        });

        if (!$isAuthorized) {
            Session::flash('error', 'Bạn không có quyền kết luận đơn khám này.');
            return redirect()->back();
        }

        // Cập nhật dữ liệu
        $medical_certificate->update([
            'patient_id' => $request->patient_id,
            'symptom' => $request->symptom,
            'diagnosis' => $request->diagnosis,
            'conclude' => $request->conclude, // ✅ cập nhật đúng cột conclude
            're_examination_date' => $request->re_examination_date,
            'medical_status' => 2,
            'discharge_date' => Carbon::now(),
            'doctor_id' => $medical_certificate->doctor_id ?: $adminId,
        ]);

        // Xử lý file nếu có
        if ($request->hasFile('result_file')) {
            $file = $request->file('result_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = time() . '_' . Str::slug($originalName) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);

            if ($medical_certificate->result_file && file_exists(public_path($medical_certificate->result_file))) {
                unlink(public_path($medical_certificate->result_file));
            }

            $medical_certificate->result_file = '/uploads/services/' . $filename;
            $medical_certificate->save();
        }

        Session::flash('success', 'Kết luận khám thành công');
        return redirect()->route('medical-certificate.index');

    } catch (\Exception $e) {
        Session::flash('error', 'Có lỗi khi kết luận: ' . $e->getMessage());
        return redirect()->back();
    }
}


    public function payment_confirm($id)
    {
        $this->authorize('xac-nhan-thanh-toan');
        $medical_certificate = MedicalCertificate::findOrFail($id);
        if ($medical_certificate->payment_status == 1) {
            return response()->json([
                'success' => false,
                'message' => 'Giấy khám bệnh này đã được thanh toán trước đó.'
            ]);
        }
        try {
            $medical_certificate->update(['payment_status' => 1]);
            return response()->json([
                'success' => true,
                'message' => 'Giấy khám bệnh đã thanh toán thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi thanh toán'
            ]);
        }
    }

    public function print($id)
    {
        $medical_certificate = MedicalCertificate::findOrFail($id);
        $pdf = Pdf::loadView('admin.medical-certificate.print', compact('medical_certificate'));
        return $pdf->stream('giay-kham-benh.pdf');
    }

    public function print_advance($id)
    {
        $medical_certificate = MedicalCertificate::findOrFail($id);
        if ($medical_certificate->medical_status == 2) {
            Session::flash('error', 'Giấy khám bệnh đã khám hoàn tất');
            return redirect()->back();
        }
        $auth = auth()->guard('admin')->user();
        $pdf = Pdf::loadView('admin.medical-certificate.advance', compact('medical_certificate', 'auth'));
        return $pdf->stream('phieu-thu-tam-ung.pdf');
    }

    public function payment_advance($id)
    {
        $this->authorize('xac-nhan-thanh-toan');
        $medical_certificate = MedicalCertificate::findOrFail($id);
        if ($medical_certificate->payment_status == 2) {
            return response()->json([
                'success' => false,
                'message' => 'Giấy khám bệnh này đã được thanh toán tạm ứng.'
            ]);
        }

        if ($medical_certificate->payment_status == 1) {
            return response()->json([
                'success' => false,
                'message' => 'Giấy khám bệnh này đã được thanh toán.'
            ]);
        }
        try {
            $medical_certificate->update(['payment_status' => 2]);
            return response()->json([
                'success' => true,
                'message' => 'Thanh toán tạm ứng thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi thanh toán'
            ]);
        }
    }
    public function exportMedicalCertificates()
    {
        return Excel::download(new MedicalCertificateExport, 'giay_kham.xlsx');
    }
}
