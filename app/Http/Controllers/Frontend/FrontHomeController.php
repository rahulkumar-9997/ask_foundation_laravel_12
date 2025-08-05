<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\BannerVideos;
use App\Models\Doctors;
use App\Models\Blog;

class FrontHomeController extends Controller
{
    public function home(){
        $data['bannerVideo'] = BannerVideos::select(['title', 'subtitle', 'description', 'button_link', 'video_popup_url', 'desktop_video_url', 'features', 'mobile_video_url'])
        ->orderBy('id', 'desc')
        ->first();
        $data['blog'] = Blog::where('status', 'Published')->orderBy('created_at', 'desc')
        ->inRandomOrder()
        ->limit(3)
        ->get();
        //return response()->json($data['blog']);
        return view('frontend.index', compact('data'));
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

    public function blogList(){
        return view('frontend.pages.blog.blog-list');
    }

    public function blogDetails(){
        return view('frontend.pages.blog.blog-details');
    }
}
