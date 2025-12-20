<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Models\Blog;
use App\Models\Doctors;
use App\Models\Activity;
use App\Models\Page;
use Carbon\Carbon;
class SiteMapController extends Controller
{
    public function index()
    {
        $urls = [];

        /* ------------------
         | Static pages
         ------------------*/
        $staticRoutes = [
            route('home'),
            route('about-us'),
            route('contact-us'),
            route('blog'),
            route('our-doctors'),
            route('our-activities'),
            route('donate-us'),
            route('focus.bone'),
            route('focus.road'),
            route('focus.preventive'),
            route('focus.education'),
        ];

        foreach ($staticRoutes as $url) {
            $urls[] = [
                'loc' => $url,
                'lastmod' => Carbon::now()->toDateString(),
                'priority' => '0.8'
            ];
        }

        /* ------------------
         | Blogs
         ------------------*/
        Blog::where('status', 'published')->latest()->get()->each(function ($blog) use (&$urls) {
            $urls[] = [
                'loc' => route('blog.details', $blog->slug),
                'lastmod' => optional($blog->updated_at)->toDateString(),
                'priority' => '0.7'
            ];
        });

        /* ------------------
         | Doctors
         ------------------*/
        Doctors::where('status', 1)->get()->each(function ($doctor) use (&$urls) {
            $urls[] = [
                'loc' => route('doctor.details', $doctor->slug),
                'lastmod' => optional($doctor->updated_at)->toDateString(),
                'priority' => '0.7'
            ];
        });

        /* ------------------
         | Activities
         ------------------*/
        Activity::where('status', 1)->get()->each(function ($activity) use (&$urls) {
            $urls[] = [
                'loc' => route('activities.details', $activity->slug),
                'lastmod' => optional($activity->updated_at)->toDateString(),
                'priority' => '0.7'
            ];
        });

        /* ------------------
         | CMS Pages
         ------------------*/
        Page::where('is_active', 1)->get()->each(function ($page) use (&$urls) {
            $urls[] = [
                'loc' => url($page->slug),
                'lastmod' => optional($page->updated_at)->toDateString(),
                'priority' => '0.6'
            ];
        });

        return response()
            ->view('frontend.sitemap.xml', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }
}
