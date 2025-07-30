<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Doctors;

class FrontHomeController extends Controller
{
    public function home(){
        return view('frontend.index');
    }

    public function ourDoctorsList(){
        $doctors = Doctors::orderBy('id', 'desc')->paginate(20);
        return view('frontend.pages.doctors.doctors-list', compact('doctors'));
    }

    public function ourDoctorsDetails($slug){
        $doctorsList = $doctors = Doctors::orderBy('id', 'desc')->get();
        $doctor = Doctors::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.doctors.doctors-details', compact('doctor', 'doctorsList'));
    }
}
