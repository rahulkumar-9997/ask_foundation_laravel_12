<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\BannerVideos;

class BannerController extends Controller
{
    public function index()
    {
        $banners = BannerVideos::orderBy('id', 'desc')->get();
        return view('backend.pages.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('backend.pages.banner.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'desktop_video_file' => 'required|file|mimes:mp4,avi,mov,wmv,flv|max:51200', // 50MB
            'mobile_video_file' => 'required|file|mimes:mp4,avi,mov,wmv,flv|max:51200', // 50MB
            'banner_video_title' => 'nullable|string|max:255',
            'banner_video_subtitle' => 'nullable|string|max:255',
            'banner_description' => 'nullable|string|max:1000',
            'banner_button_link' => 'nullable|url|max:255',
            'button_popup_url' => 'nullable|url|max:255',
            'banner_link' => 'nullable|url|max:255',
            'video_features' => 'nullable|array',
            'video_features.*' => 'nullable|string|max:255',
        ], [
            'desktop_video_file.required' => 'Desktop video file is required.',
            'desktop_video_file.mimes' => 'Desktop video must be a valid video file (MP4, AVI, MOV, WMV, FLV).',
            'desktop_video_file.max' => 'Desktop video file size must not exceed 50MB.',
            'mobile_video_file.required' => 'Mobile video file is required.',
            'mobile_video_file.mimes' => 'Mobile video must be a valid video file (MP4, AVI, MOV, WMV, FLV).',
            'mobile_video_file.max' => 'Mobile video file size must not exceed 50MB.',
            'banner_button_link.url' => 'Button link must be a valid URL.',
            'button_popup_url.url' => 'Button popup URL must be a valid URL.',
            'banner_link.url' => 'Banner link must be a valid URL.',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction(); 
        try {
            $destinationPath = public_path('upload/banner');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $desktopVideoPath = $this->uploadVideo($request->file('desktop_video_file'), 'desktop');
            $mobileVideoPath = $this->uploadVideo($request->file('mobile_video_file'), 'mobile');
            $features = [];
            if ($request->video_features) {
                $features = array_filter($request->video_features, function($feature) {
                    return !empty(trim($feature));
                });
            }
            
            BannerVideos::create([
                'title' => $request->banner_video_title,
                'subtitle' => $request->banner_video_subtitle,
                'description' => $request->banner_description,
                'button_link' => $request->banner_button_link,
                'video_popup_url' => $request->button_popup_url,
                'desktop_video_url' => $desktopVideoPath,
                'mobile_video_url' => $mobileVideoPath,
                'features' => $features,
                'is_active' => true,
            ]);            
            DB::commit();             
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Banner video created successfully!',
                    ]
                );
            }
            
            return redirect()->route('manage-banner.index')
                ->with('success', 'Banner video created successfully!');

        } catch (Exception $e) {
            DB::rollBack();
            if (isset($desktopVideoPath)) {
                $fullDesktopPath = public_path('upload/banner/' . basename($desktopVideoPath));
                if (file_exists($fullDesktopPath)) {
                    @unlink($fullDesktopPath);
                }
            }
            if (isset($mobileVideoPath)) {
                $fullMobilePath = public_path('upload/banner/' . basename($mobileVideoPath));
                if (file_exists($fullMobilePath)) {
                    @unlink($fullMobilePath);
                }
            }

            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Error creating banner video: ' . $e->getMessage(),
                    ],
                    500
                );
                
            }

            return redirect()->back()
                ->with('error', 'Error creating banner video: ' . $e->getMessage())
                ->withInput();
        }
    }

    private function uploadVideo($videoFile, $type)
    {
        $destinationPath = public_path('upload/banner');
        $extension = $videoFile->getClientOriginalExtension();
        $filename = $type . '.' . $extension;
        if (file_exists($destinationPath . '/' . $filename)) {
            $filename = $type . '_' . time() . '.' . $extension;
        }
        $videoFile->move($destinationPath, $filename);
        return $filename;
    }
    
    public function edit($id)
    {
        $banner = BannerVideos::findOrFail($id);
        return view('backend.pages.banner.edit', [
            'banner' => $banner,
            'video_features' => $banner->features ?? []
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'desktop_video_file' => 'nullable|file|mimes:mp4,avi,mov,wmv,flv|max:51200',
            'mobile_video_file' => 'nullable|file|mimes:mp4,avi,mov,wmv,flv|max:51200',
            'banner_video_title' => 'nullable|string|max:255',
            'banner_video_subtitle' => 'nullable|string|max:255',
            'banner_description' => 'nullable|string|max:1000',
            'banner_button_link' => 'nullable|url|max:255',
            'button_popup_url' => 'nullable|url|max:255',
            'video_features' => 'nullable|array',
            'video_features.*' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $banner = BannerVideos::findOrFail($id);
        DB::beginTransaction();        
        try {
            $destinationPath = public_path('upload/banner');
            $data = [
                'title' => $request->banner_video_title,
                'subtitle' => $request->banner_video_subtitle,
                'description' => $request->banner_description,
                'button_link' => $request->banner_button_link,
                'video_popup_url' => $request->button_popup_url,
            ];
            if ($request->hasFile('desktop_video_file')) {
                if ($banner->desktop_video_url && file_exists($destinationPath . '/' . basename($banner->desktop_video_url))) {
                    unlink($destinationPath . '/' . basename($banner->desktop_video_url));
                }
                $desktopVideoPath = $this->uploadVideo($request->file('desktop_video_file'), 'desktop');
                $data['desktop_video_url'] = $desktopVideoPath;
            }

            if ($request->hasFile('mobile_video_file')) {
                if ($banner->mobile_video_url && file_exists($destinationPath . '/' . basename($banner->mobile_video_url))) {
                    unlink($destinationPath . '/' . basename($banner->mobile_video_url));
                }
                $mobileVideoPath = $this->uploadVideo($request->file('mobile_video_file'), 'mobile');
                $data['mobile_video_url'] = $mobileVideoPath;
            }

            if ($request->video_features) {
                $features = array_filter($request->video_features, function($feature) {
                    return !empty(trim($feature));
                });
                $data['features'] = $features;
            }
            $banner->update($data);
            DB::commit();
            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Banner video updated successfully!'
                ]);
            }
            return redirect()->route('manage-banner.index')->with('success', 'Banner video updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Banner update failed: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error updating banner video: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()
                ->with('error', 'Error updating banner video: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function destroy($id)
    {
        $banner = BannerVideos::findOrFail($id);
        $destinationPath = public_path('upload/banner');
        DB::beginTransaction();
        try {
            if ($banner->desktop_video_url) {
                $desktopPath = $destinationPath . '/' . basename($banner->desktop_video_url);
                if (file_exists($desktopPath) && is_file($desktopPath)) {
                    @unlink($desktopPath); 
                }
            }
            if ($banner->mobile_video_url) {
                $mobilePath = $destinationPath . '/' . basename($banner->mobile_video_url);
                if (file_exists($mobilePath) && is_file($mobilePath)) {
                    @unlink($mobilePath);
                }
            }
            $banner->delete();
            DB::commit();
            return redirect()
                ->route('manage-banner.index')
                ->with('success', 'Banner and associated files deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Banner deletion failed: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to delete banner: ' . $e->getMessage());
        }
    }
   
}
