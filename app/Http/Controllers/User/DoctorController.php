<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function doctors()
    {
        $title = 'Các bác sĩ của HEALING CARE';
        $doctors =  Admin::role('admin')->where('status', 1)->with('department')->get();
        return view('user.doctor.doctors', compact('title', 'doctors'));
    }

    public function doctor_detail($slugDoctor)
    {
        $doctor = Admin::role('admin')->where('slug', $slugDoctor)->where('status', 1)->first();
        $title = 'Bs ' . $doctor->name;
        $doctors =  Admin::role('admin')->with('department')->get();
        return view('user.doctor.doctor-detail', compact('title', 'doctors', 'doctor'));
    }
}
