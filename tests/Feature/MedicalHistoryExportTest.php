<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Clinic;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MedicalCertificateExport;

class MedicalHistoryExportTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Clinic::factory()->create(['id' => 1]);
    }

    /** @test */
    public function it_exports_medical_certificates_to_excel()
    {
        Excel::fake();

        $admin = Admin::factory()->create([
            'clinic_id' => 1,
            'department_id' => 1,
            'gender' => 1,
            'experience' => '5 năm'
        ]);

        $this->actingAs($admin, 'admin');

        $response = $this->get(route('medical-certificates.export'));

        $response->assertStatus(200);

        Excel::assertDownloaded('giay_kham.xlsx', function (MedicalCertificateExport $export) {
            return true;
        });
    }
}
