<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCertificateService extends Model
{
    use HasFactory;

    protected $table = 'medical_certificate_service';

    protected $fillable = [
        'medical_certificate_id',
        'medical_service_id',
        'clinic_id',
        'doctor_id',
        'medical_time',
        'note',
    ];

    public function service()
    {
        return $this->belongsTo(MedicalService::class,'medical_service_id');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    
}
