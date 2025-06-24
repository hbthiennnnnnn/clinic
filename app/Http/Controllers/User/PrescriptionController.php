<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prescription;

class PrescriptionController extends Controller
{
    public function show($id)
    {
         $prescription = Prescription::with(['medicines', 'medical_certificate.patient'])->findOrFail($id);

        return view('user.prescription.show', compact('prescription'));
    }
}
