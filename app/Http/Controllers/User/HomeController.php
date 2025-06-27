<?php

namespace App\Http\Controllers\User;

use App\Events\AppointmentEvent;
use App\Events\ContactEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\BookAppointmentRequest;
use App\Http\Requests\User\ContactRequest;
use App\Jobs\AppointmentJob;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Contact;
use App\Models\Department;
use App\Models\MedicalService;
use App\Models\WorkSchedule;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function home()
    {
        $title = 'Trang chủ';
        $departments = Department::where('status', 1)->orderByDesc('id')->get();
        $doctors = Admin::role('Bác sĩ')->where('status', 1)->orderByDesc('id')->get();
        $doctors = [];
        $news = News::with('newsCategories')->where('status', 1)->orderByDesc('id')->take(9)->get();
        $clinic = Clinic::count();
        $patient = Patient::count();
        return view('user.home.trangchu', compact('title', 'news', 'departments', 'doctors', 'clinic', 'patient'));
    }

    public function contact_form()
    {
        $title = 'Liên hệ với chúng tôi';
        return view('user.home.contact', compact('title'));
    }

    public function contact(ContactRequest $request)
    {
        try {
            $data = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'title' => $request->title,
                'message' => $request->message,
                'status' => 0
            ]);
            $count = Contact::where('status', 0)->count();
            event(new ContactEvent($data['title'], $data['name'], $data['id'], $count));
            Session::flash('success', 'Gửi liên hệ thành công');
        } catch (\Exception $e) {
            Session::flash('error', 'Có lỗi khi liên hệ' . $e->getMessage());
        }
        return redirect()->back();
    }


    public function getAvailableSlots(Request $request)
    {
        $doctor_id = $request->query('doctor_id');
        $date = $request->query('date');
        $session = $request->query('session'); // 'morning' hoặc 'afternoon'

        $schedule = WorkSchedule::where('staff_id', $doctor_id)->first();
        if (!$schedule) return response()->json([]);

        $weekday = Carbon::parse($date)->dayOfWeek;
        if ($weekday < 1 || $weekday > 5) return response()->json([]); // 1-5 là T2 -> T6

        // Kiểm tra nếu có lịch ở buổi được chọn
        $available = match ($session) {
            'morning' => $schedule->morning_start && $schedule->morning_end,
            'afternoon' => $schedule->afternoon_start && $schedule->afternoon_end,
            default => false,
        };

        return response()->json([
            'available' => $available,
            'start' => $session === 'morning' ? $schedule->morning_start : $schedule->afternoon_start,
            'end' => $session === 'morning' ? $schedule->morning_end : $schedule->afternoon_end,
        ]);
    }



    private function generateSlots($start, $end, $duration)
    {
        $slots = [];
        $current = Carbon::parse($start);
        $end = Carbon::parse($end);

        while ($current->lt($end)) {
            $slots[] = [
                'start' => $current->format('H:i'),
                'end' => $current->copy()->addMinutes($duration)->format('H:i'),
            ];
            $current->addMinutes($duration);
        }

        return $slots;
    }

    public function book_appointment_page(Request $request)
    {
        $title = 'Đặt lịch hẹn khám';
        $departments = Department::where('status', 1)->orderByDesc('id')->get();

        $doctors = Admin::role('Bác sĩ')->where('status', 1)->orderByDesc('id')->get();

        $selectedDoctor = null;
        $selectedDepartmentId = null;
        if ($request->has('doctor_id')) {
            $selectedDoctor = Admin::with('department')->find($request->doctor_id);
            if ($selectedDoctor && $selectedDoctor->department) {
                $selectedDepartmentId = $selectedDoctor->department->id;
            }
        }

        return view('user.home.trangchu', compact('title', 'departments', 'doctors', 'selectedDoctor', 'selectedDepartmentId'));
    }

    public function book_appointment(BookAppointmentRequest $request)
    {
        try {
            $schedule = WorkSchedule::where('staff_id', $request->doctor_id)->first();

            if (!$schedule) {
                return response()->json(['success' => false, 'message' => 'Bác sĩ không có lịch làm việc.']);
            }

            // Lấy khung giờ tương ứng theo session
            if ($request->session === 'morning') {
                $start_time = $schedule->morning_start;
            } elseif ($request->session === 'afternoon') {
                $start_time = $schedule->afternoon_start;
            } else {
                return response()->json(['success' => false, 'message' => 'Vui lòng chọn buổi khám.']);
            }

            $data = Appointment::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'department_id' => $request->department_id,
                'doctor_id' => $request->doctor_id,
                'appointment_date' => $request->appointment_date,
                'session' => $request->session, // NEW FIELD: buổi sáng hoặc chiều
                'start_time' => $start_time,    // Vẫn lưu nếu muốn
                'note' => $request->note,
                'is_viewed' => false,
                'status' => 0,
                'cancel_token' => Str::uuid(),
            ]);

            AppointmentJob::dispatch($data->email, $data->cancel_token)->delay(now()->addSecond(10));
            $count = Appointment::where('is_viewed', false)->count();
            $doctor = Admin::find($data['doctor_id']);
            event(new AppointmentEvent($data['name'], $data['id'], $count, $doctor->name));

            return response()->json(['success' => true, 'message' => 'Đặt lịch khám thành công']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi khi đặt lịch khám!']);
        }
    }

    public function getDoctors($department_id)
    {
        $doctors = Admin::role('Bác sĩ')->whereHas('clinic', function ($query) use ($department_id) {
            $query->where('department_id', $department_id);
            $query->where('status', 1);
        })->get();

        return response()->json($doctors);
    }

    public function cancel($token)
    {
        $appointment = Appointment::where('cancel_token', $token)->first();
        if (!$appointment) {
            return redirect()->route('home')->with('error', 'Lịch hẹn không tồn tại hoặc đã bị hủy.');
        }
        $appointment->delete();
        return redirect()->route('home')->with('success', 'Lịch hẹn đã được hủy thành công.');
    }


    public function search(Request $request)
    {
        $query = $request->input('q');
        $news = News::when($query, function ($q) use ($query) {
            $q->where('title', 'like', '%' . $query . '%');
            $q->where('status', 1);
        })->orderByDesc('id')->paginate(12)->appends(request()->query());

        $title = 'Tìm kiếm bài viết';
        return view('user.news.search', compact('news', 'title'));
    }

    public function service_price()
    {
        $medical_services = MedicalService::where('status', 1)->orderByDesc('id')->paginate(6);
        $news = News::with('newsCategories')->where('status', 1)->orderByDesc('id')->take(5)->get();
        $categories = NewsCategory::where('status', 1)->orderByDesc('id')->get();
        $title = 'Bảng giá dịch vụ';
        return view('user.home.service-price', compact('title', 'medical_services', 'news', 'categories'));
    }
}
