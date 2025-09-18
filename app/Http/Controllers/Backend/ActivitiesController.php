<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivitiesImage;
use App\Models\ActivitiesVideo;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ActivitiesController extends Controller
{
    public function index()
    {       
        $activities = Activity::with(['images', 'videos'])->paginate(20); 
        return view('backend.pages.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('backend.pages.activities.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'required|string',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'page_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'more_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'act_video_title.*' => 'nullable|string|max:255',
            'activities_video_file.*' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:10240',
            'activities_video_link.*' => 'nullable|url',
        ], [
            'main_image.required' => 'The main image is required.',
            'content.required' => 'The content field is required.',
            'more_image.*.image' => 'Each additional image must be a valid image file.',
            'more_image.*.max' => 'Each additional image must not exceed 2MB.',
            'activities_video_file.*.mimes' => 'Video files must be in MP4, AVI, MOV, or WMV format.',
            'activities_video_file.*.max' => 'Video files must not exceed 10MB.',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        $destinationPath = public_path('upload/activities');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        } 
        $titleSlug = Str::slug($request->title); 
        if ($request->hasFile('main_image')) {
            $mainImageName = $titleSlug . '-' . uniqid() . '.webp'; 
            $mainImage = Image::make($request->file('main_image')->getRealPath());
            $mainImage->encode('webp', 90)->save($destinationPath . '/' . $mainImageName);
        }
        $pageImageName = null;
        if ($request->hasFile('page_image')) {
            $pageImageName = $titleSlug . '-page-' . uniqid() . '.webp';
            $pageImage = Image::make($request->file('page_image')->getRealPath());
            $pageImage->encode('webp', 90)->save($destinationPath . '/' . $pageImageName);
        }
        $activity = Activity::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_content' => $request->short_description,
            'long_content' => $request->content,
            'main_image' => $mainImageName,
            'page_image' => $pageImageName,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => 1,
            'post_date' => now(),
        ]);
        if ($request->hasFile('more_image')) {
            $moreImages = $request->file('more_image');
            $imageCount = min(count($moreImages), 15);            
            for ($i = 0; $i < $imageCount; $i++) {
                $moreImageName = $titleSlug . '-more-' . uniqid() . '.webp';                
                $moreImage = Image::make($moreImages[$i]->getRealPath());
                $moreImage->encode('webp', 90)->save($destinationPath . '/' . $moreImageName);
                ActivitiesImage::create([
                    'activities_id' => $activity->id,
                    'title' => $request->title . ' Additional Image ' . ($i + 1),
                    'image' => $moreImageName,
                    'short_order' => $i + 1,
                ]);
            }
        }
        $videoDestinationPath = public_path('upload/activities/videos');
        if (!file_exists($videoDestinationPath)) {
            mkdir($videoDestinationPath, 0755, true);
        }  
        $hasVideoFiles = $request->hasFile('activities_video_file');
        $hasVideoLinks = !empty(array_filter($request->activities_video_link ?? []));
        if ($hasVideoFiles || $hasVideoLinks) {
            $videoTitles = $request->act_video_title ?? [];
            $videoFiles = $request->file('activities_video_file') ?? [];
            $videoLinks = $request->activities_video_link ?? [];            
            foreach (array_keys(array_merge($videoFiles, $videoLinks)) as $index) {
                $currentVideoFile = $videoFiles[$index] ?? null;
                $currentVideoLink = $videoLinks[$index] ?? null;                
                if (empty($currentVideoFile) && empty($currentVideoLink)) {
                    continue;
                }                
                $videoFileName = null;
                $videoLink = null;
                $videoTitle = $videoTitles[$index] ?? 'Video ' . ($index + 1);
                if (!empty($currentVideoFile)) {
                    $videoFileName = $titleSlug . '-video-' . uniqid() . '.' . $currentVideoFile->getClientOriginalExtension();
                    $currentVideoFile->move($videoDestinationPath, $videoFileName);
                }
                if (!empty($currentVideoLink)) {
                    $videoLink = $currentVideoLink;
                }                
                ActivitiesVideo::create([
                    'activities_id' => $activity->id,
                    'title' => $videoTitle,
                    'video_path' => $videoFileName,
                    'video_link' => $videoLink,
                    'short_order' => $index + 1,
                ]);
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Activity created successfully!',
            'redirect_url' => route('manage-activities.index')
        ]);
    }

    public function edit($id)
    {
        $activity = Activity::with(['images', 'videos'])->findOrFail($id);
        return view('backend.pages.activities.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::with(['images', 'videos'])->findOrFail($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'page_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'more_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'act_video_title.*' => 'nullable|string|max:255',
            'activities_video_file.*' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:10240',
            'activities_video_link.*' => 'nullable|url',
            'new_act_video_title.*' => 'nullable|string|max:255',
            'new_activities_video_file.*' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:10240',
            'new_activities_video_link.*' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Process main image if changed
        $mainImageName = $activity->main_image;
        if ($request->hasFile('main_image')) {
            $titleSlug = Str::slug($request->title);
            $mainImageName = $titleSlug . '-' . uniqid() . '.webp';
            
            $destinationPath = public_path('upload/activities');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $mainImage = Image::make($request->file('main_image')->getRealPath());
            $mainImage->encode('webp', 90)->save($destinationPath . '/' . $mainImageName);
            
            // Delete old main image
            if ($activity->main_image && file_exists($destinationPath . '/' . $activity->main_image)) {
                unlink($destinationPath . '/' . $activity->main_image);
            }
        } elseif ($request->has('remove_main_image')) {
            // Remove main image if requested
            $destinationPath = public_path('upload/activities');
            if ($activity->main_image && file_exists($destinationPath . '/' . $activity->main_image)) {
                unlink($destinationPath . '/' . $activity->main_image);
            }
            $mainImageName = null;
        }

        // Process page image if changed
        $pageImageName = $activity->page_image;
        if ($request->hasFile('page_image')) {
            $titleSlug = Str::slug($request->title);
            $pageImageName = $titleSlug . '-page-' . uniqid() . '.webp';
            
            $destinationPath = public_path('upload/activities');
            $pageImage = Image::make($request->file('page_image')->getRealPath());
            $pageImage->encode('webp', 90)->save($destinationPath . '/' . $pageImageName);
            
            // Delete old page image
            if ($activity->page_image && file_exists($destinationPath . '/' . $activity->page_image)) {
                unlink($destinationPath . '/' . $activity->page_image);
            }
        } elseif ($request->has('remove_page_image')) {
            // Remove page image if requested
            $destinationPath = public_path('upload/activities');
            if ($activity->page_image && file_exists($destinationPath . '/' . $activity->page_image)) {
                unlink($destinationPath . '/' . $activity->page_image);
            }
            $pageImageName = null;
        }

        // Update the activity
        $activity->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_content' => $request->short_description,
            'long_content' => $request->content,
            'main_image' => $mainImageName,
            'page_image' => $pageImageName,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        // Process additional images
        if ($request->hasFile('more_image')) {
            $moreImages = $request->file('more_image');
            $imageCount = min(count($moreImages), 15);
            $currentImageCount = $activity->images->count();
            $maxImages = 15 - $currentImageCount;
            $imageCount = min($imageCount, $maxImages);
            
            for ($i = 0; $i < $imageCount; $i++) {
                $moreImageName = $titleSlug . '-more-' . uniqid() . '.webp';
                
                $moreImage = Image::make($moreImages[$i]->getRealPath());
                $moreImage->encode('webp', 90)->save($destinationPath . '/' . $moreImageName);
                
                ActivitiesImage::create([
                    'activities_id' => $activity->id,
                    'title' => $request->title . ' Additional Image ' . ($currentImageCount + $i + 1),
                    'image' => $moreImageName,
                    'short_order' => $currentImageCount + $i + 1,
                ]);
            }
        }
        
        // Remove selected images
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageId) {
                $image = ActivitiesImage::find($imageId);
                if ($image) {
                    // Delete file
                    if (file_exists($destinationPath . '/' . $image->image)) {
                        unlink($destinationPath . '/' . $image->image);
                    }
                    // Delete record
                    $image->delete();
                }
            }
        }

        // Process existing videos
        if ($request->has('existing_video_ids')) {
            foreach ($request->existing_video_ids as $videoId) {
                $video = ActivitiesVideo::find($videoId);
                if (!$video) continue;
                
                // Check if video should be deleted
                if ($request->has('remove_videos') && in_array($videoId, $request->remove_videos)) {
                    // Delete video file if exists
                    if ($video->video_path && file_exists(public_path($video->video_path))) {
                        unlink(public_path($video->video_path));
                    }
                    $video->delete();
                    continue;
                }
                
                // Update video title
                $video->title = $request->act_video_title[$videoId] ?? $video->title;
                
                // Process video file if changed
                if ($request->hasFile('activities_video_file') && isset($request->file('activities_video_file')[$videoId])) {
                    $videoFile = $request->file('activities_video_file')[$videoId];
                    $videoFileName = Str::slug($request->title) . '-video-' . uniqid() . '.' . $videoFile->getClientOriginalExtension();
                    
                    $videoDestinationPath = public_path('upload/activities/videos');
                    if (!file_exists($videoDestinationPath)) {
                        mkdir($videoDestinationPath, 0755, true);
                    }
                    
                    // Delete old video file if exists
                    if ($video->video_path && file_exists(public_path($video->video_path))) {
                        unlink(public_path($video->video_path));
                    }
                    
                    $videoFile->move($videoDestinationPath, $videoFileName);
                    $video->video_path = 'upload/activities/videos/' . $videoFileName;
                    $video->video_link = null; // Remove link if file is uploaded
                } elseif ($request->has('remove_video_files') && in_array($videoId, $request->remove_video_files)) {
                    // Remove video file if requested
                    if ($video->video_path && file_exists(public_path($video->video_path))) {
                        unlink(public_path($video->video_path));
                    }
                    $video->video_path = null;
                }
                
                // Update video link if provided
                if (isset($request->activities_video_link[$videoId]) && !empty($request->activities_video_link[$videoId])) {
                    $video->video_link = $request->activities_video_link[$videoId];
                    // If setting a link, remove any file
                    if ($video->video_path && file_exists(public_path($video->video_path))) {
                        unlink(public_path($video->video_path));
                    }
                    $video->video_path = null;
                }
                
                $video->save();
            }
        }
        
        // Process new videos
        if ($request->has('new_act_video_title')) {
            $newVideoTitles = $request->new_act_video_title;
            $newVideoFiles = $request->file('new_activities_video_file') ?? [];
            $newVideoLinks = $request->new_activities_video_link ?? [];
            
            foreach ($newVideoTitles as $index => $title) {
                // Skip if both file and link are empty
                $currentVideoFile = $newVideoFiles[$index] ?? null;
                $currentVideoLink = $newVideoLinks[$index] ?? null;
                
                if (empty($currentVideoFile) && empty($currentVideoLink)) {
                    continue;
                }
                
                $videoPath = null;
                $videoLink = null;
                
                // Process video file if exists
                if (!empty($currentVideoFile)) {
                    $videoFileName = Str::slug($request->title) . '-video-' . uniqid() . '.' . $currentVideoFile->getClientOriginalExtension();
                    
                    $videoDestinationPath = public_path('upload/activities/videos');
                    if (!file_exists($videoDestinationPath)) {
                        mkdir($videoDestinationPath, 0755, true);
                    }
                    
                    $currentVideoFile->move($videoDestinationPath, $videoFileName);
                    $videoPath = 'upload/activities/videos/' . $videoFileName;
                }
                
                // Use video link if provided
                if (!empty($currentVideoLink)) {
                    $videoLink = $currentVideoLink;
                }
                
                ActivitiesVideo::create([
                    'activities_id' => $activity->id,
                    'title' => $title,
                    'video_path' => $videoPath,
                    'video_link' => $videoLink,
                    'short_order' => $activity->videos->count() + $index + 1,
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Activity updated successfully!',
            'redirect_url' => route('manage-activities.index')
        ]);
    }

}
