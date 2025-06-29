<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\MedicalCertificate;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\DB;

class StripePaymentController extends Controller
{
    /**
     * Tạo phiên thanh toán Stripe
     */
    public function createCheckout($id)
    {
        $patientCode = auth()->user()->patient_code;

        $prescription = Prescription::whereHas('medical_certificate.patient', function ($query) use ($patientCode) {
            $query->where('patient_code', $patientCode);
        })->findOrFail($id);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Không cần đổi đơn vị nữa
        $vnAmount = $prescription->total_payment;

        $session = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'vnd', // ✅ đổi từ 'usd' → 'vnd'
                    'product_data' => [
                        'name' => 'Đơn thuốc #' . $prescription->prescription_code,
                    ],
                    'unit_amount' => $vnAmount, // đơn vị là VND
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('user.stripe.success', ['id' => $prescription->id]),
            'cancel_url' => route('user.stripe.cancel'),
        ]);

        return redirect($session->url);
    }

    /**
     * Giao diện sau khi thanh toán thành công
     */
    public function success($id)
    {
        // Kiểm tra quyền truy cập prescription
        $prescription = Prescription::whereHas('medical_certificate.patient.user', function ($query) {
            $query->where('id', auth()->id());
        })->findOrFail($id);

        // Cập nhật trạng thái prescription & giấy khám bệnh
        DB::transaction(function () use ($prescription) {
            $prescription->status = 1; // nếu bạn có cột status trong bảng prescription
            $prescription->save();

            if ($prescription->medical_certificate_id) {
                $medical = MedicalCertificate::find($prescription->medical_certificate_id);
                if ($medical) {
                    $medical->payment_status = 1;
                    $medical->save();
                }
            }
        });

        return view('user.stripe.success', compact('prescription'));
    }

    /**
     * Giao diện khi thanh toán bị huỷ
     */
    public function cancel()
    {
        return view('user.stripe.cancel');
    }

    public function history()
    {
        $userId = auth()->id();

        $prescriptions = Prescription::whereHas('medical_certificate.patient.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->with('medical_certificate')->get();

        $services = MedicalCertificate::whereHas('patient.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })
            ->where('payment_status', 1)
            ->with('services')
            ->get();

        return view('user.auth.payment-history', compact('prescriptions', 'services'));
    }


    public function createServiceCheckout($id)
    {
        $medical = MedicalCertificate::whereHas('patient.user', function ($query) {
            $query->where('id', auth()->id());
        })->findOrFail($id);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Tính tổng chi phí dịch vụ khám
        $total = 0;
        foreach ($medical->services as $service) {
            $price = $service->price;
            if ($medical->insurance) {
                $price *= 0.8;
            }
            $total += $price;
        }

        $session = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'vnd',
                    'product_data' => [
                        'name' => 'Thanh toán dịch vụ khám #' . $medical->medical_certificate_code,
                    ],
                    'unit_amount' => $total,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('user.service.success', ['id' => $medical->id]),
            'cancel_url' => route('user.stripe.cancel'),
        ]);

        return redirect($session->url);
    }

    public function serviceSuccess($id)
    {
        $medical = MedicalCertificate::whereHas('patient.user', function ($query) {
            $query->where('id', auth()->id());
        })->findOrFail($id);

        $medical->payment_status = 1;
        $medical->save();

        return view('user.stripe.service_success', compact('medical'));
    }

    public function createCombinedCheckout($id)
    {
        $userId = auth()->id();

        $medical = MedicalCertificate::whereHas('patient.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->with('services', 'prescription')->findOrFail($id);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = [];

        $total = 0;

        // Đơn thuốc (nếu chưa thanh toán)
        if ($medical->prescription && $medical->prescription->status != 1) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'vnd',
                    'product_data' => [
                        'name' => 'Đơn thuốc #' . $medical->prescription->prescription_code,
                    ],
                    'unit_amount' => $medical->prescription->total_payment,
                ],
                'quantity' => 1,
            ];
            $total += $medical->prescription->total_payment;
        }

        // Dịch vụ khám (nếu chưa thanh toán)
        if ($medical->payment_status != 1 && $medical->services->isNotEmpty()) {
            $serviceTotal = 0;
            foreach ($medical->services as $service) {
                $price = $service->price;
                if ($medical->insurance) {
                    $price *= 0.8;
                }
                $serviceTotal += $price;
            }

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'vnd',
                    'product_data' => [
                        'name' => 'Dịch vụ khám #' . $medical->medical_certificate_code,
                    ],
                    'unit_amount' => $serviceTotal,
                ],
                'quantity' => 1,
            ];
            $total += $serviceTotal;
        }

        // Nếu không có gì cần thanh toán
        if ($total == 0) {
            return redirect()->back()->with('warning', 'Không có khoản nào cần thanh toán.');
        }

        $session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('user.stripe.combined.success', ['id' => $medical->id]),
            'cancel_url' => route('user.stripe.cancel'),
        ]);

        return redirect($session->url);
    }

    public function combinedSuccess($id)
    {
        $userId = auth()->id();

        $medical = MedicalCertificate::whereHas('patient.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->with('prescription')->findOrFail($id);

        DB::transaction(function () use ($medical) {
            // Cập nhật trạng thái dịch vụ
            if ($medical->payment_status != 1) {
                $medical->payment_status = 1;
                $medical->save();
            }

            // Cập nhật trạng thái đơn thuốc
            if ($medical->prescription && $medical->prescription->status != 1) {
                $medical->prescription->status = 1;
                $medical->prescription->save();
            }
        });

        return view('user.stripe.combined_success', compact('medical'));
    }
}
