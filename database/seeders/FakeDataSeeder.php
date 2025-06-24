<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

class FakeDataSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        $certificateIndex = 1;
        $prescriptionIndex = 1;

        // 1. Tạo các dịch vụ (medical_services)
        $services = [
            'Khám thai định kỳ',
            'Tư vấn tâm lý cá nhân',
            'Khám trầm cảm, rối loạn lo âu',
            'Khám sức khỏe tổng quát',
            'Siêu âm thai 2D',
        ];

        foreach ($services as $index => $name) {
            $code = 'DV' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);

            while (DB::table('medical_services')->where('medical_service_code', $code)->where('name', '!=', $name)->exists()) {
                $code = 'DV' . rand(100, 999);
            }

            DB::table('medical_services')->updateOrInsert(
                ['name' => $name],
                [
                    'price' => rand(300_000, 1_000_000),
                    'insurance_price' => rand(100_000, 500_000),
                    'description' => 'Mô tả dịch vụ ' . $name,
                    'medical_service_code' => $code,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        $serviceIds = DB::table('medical_services')->pluck('id')->toArray();
        $doctorId = DB::table('admins')->value('id');
        $clinicId = DB::table('clinics')->value('id');

        if (!$doctorId || !$clinicId) {
            dump('⚠️ Bạn cần có ít nhất 1 bản ghi trong bảng `admins` và `clinics` trước khi seed.');
            return;
        }

        $doctorIds = DB::table('admins')->pluck('id')->toArray();
        $departmentIds = DB::table('departments')->pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $createdAt = Carbon::now()->subMonths(rand(0, 5))->subDays(rand(0, 27));

            $gender = rand(0, 1);
            $name = $gender ? $faker->name('male') : $faker->name('female');

            $patientId = DB::table('patients')->insertGetId([
                'patient_code' => 'BN' . strtoupper(Str::random(6)),
                'name' => $name,
                'dob' => $faker->dateTimeBetween('-65 years', '-18 years')->format('Y-m-d'),
                'gender' => $gender,
                'phone' => '09' . rand(10000000, 99999999),
                'address' => $faker->address(),
                'created_at' => $createdAt,
                'updated_at' => now(),
            ]);

            $visitTimes = rand(1, 3);

            for ($j = 0; $j < $visitTimes; $j++) {
                $serviceId = $serviceIds[array_rand($serviceIds)];
                $prescriptionDate = $createdAt->copy()->addDays(rand(1, 30));

                $medicalCertificateId = DB::table('medical_certificates')->insertGetId([
                    'medical_certificate_code' => 'GK' . str_pad($certificateIndex++, 8, '0', STR_PAD_LEFT),
                    'patient_id' => $patientId,
                    'doctor_id' => $doctorId,
                    'clinic_id' => $clinicId,
                    'medical_service_id' => $serviceId,
                    'medical_status' => 1,
                    'payment_status' => 1,
                    'symptom' => $faker->sentence(4),
                    'diagnosis' => $faker->sentence(5),
                    'conclude' => $faker->sentence(6),
                    'medical_time' => $prescriptionDate,
                    'created_at' => $prescriptionDate,
                    'updated_at' => now(),
                ]);

                DB::table('prescriptions')->insert([
                    'prescription_code' => 'DT' . str_pad($prescriptionIndex++, 6, '0', STR_PAD_LEFT),
                    'medical_certificate_id' => $medicalCertificateId,
                    'doctor_id' => $doctorId,
                    'note' => $faker->sentence(6),
                    'total_payment' => rand(300_000, 2_000_000),
                    'status' => 1,
                    'created_at' => $prescriptionDate,
                    'updated_at' => now(),
                ]);

                $appointmentTime = $createdAt->copy()->addDays(rand(1, 15))->setHour(rand(8, 16))->setMinute(0);

                DB::table('appointments')->insert([
                    'name' => $name,
                    'email' => $faker->unique()->safeEmail(),
                    'phone' => '09' . rand(10000000, 99999999),
                    'dob' => $faker->dateTimeBetween('-65 years', '-18 years')->format('Y-m-d'),
                    'gender' => $gender,
                    'department_id' => $faker->randomElement($departmentIds),
                    'doctor_id' => $doctorId,
                    'appointment_date' => $appointmentTime->toDateString(),
                    'start_time' => $appointmentTime->format('H:i:s'),
                    'note' => $faker->sentence(),
                    'is_viewed' => rand(0, 1),
                    'status' => rand(0, 2),
                    'cancel_token' => Str::uuid(),
                    'created_at' => $appointmentTime->copy()->subDays(1),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
