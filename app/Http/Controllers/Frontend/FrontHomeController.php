<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryMail;
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
        $blogs = Blog::orderBy('id', 'desc')->where('status', 'published')->paginate(20);
        return view('frontend.pages.blog.blog-list', compact('blogs'));
    }

    public function blogDetails($slug){
        $blog = Blog::with(['images', 'paragraphs'])->where('slug', $slug)
        ->firstOrFail();
        //return response()->json($blog);
        return view('frontend.pages.blog.blog-details', compact('blog'));
    }

    public function contactUs(){
        return view('frontend.pages.contact-us.index');
    }

    public function contactSubmitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:10',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'] ?? null,
        ];
        try {
            Mail::to('rahulkumarmaurya464@gmail.com')->send(new EnquiryMail($data));
        } catch (\Exception $e) {
            Log::error('Failed to send enquiry email: ' . $e->getMessage());
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Your enquiry form submitted successfully. Our team will contact you soon.',
        ]);
    }

    public function aboutUs(){
        return view('frontend.pages.about-us.index');
    }
}
