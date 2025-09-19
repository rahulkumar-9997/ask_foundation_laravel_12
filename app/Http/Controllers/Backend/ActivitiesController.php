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
            'activities_video_link.*' => 'nullable|string|max:255',
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
            'activities_video_link.*' => 'nullable|string|max:255',
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
        $mainImageName = $activity->main_image;
        $titleSlug = Str::slug($request->title);
        $destinationPath = public_path('upload/activities');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }    
        if ($request->hasFile('main_image')) {           
            $mainImageName = $titleSlug . '-' . uniqid() . '.webp';   
            $mainImage = Image::make($request->file('main_image')->getRealPath());
            $mainImage->encode('webp', 90)->save($destinationPath . '/' . $mainImageName);
            if ($activity->main_image && file_exists($destinationPath . '/' . $activity->main_image)) {
                unlink($destinationPath . '/' . $activity->main_image);
            }
        }
        $pageImageName = $activity->page_image;
        if ($request->hasFile('page_image')) {
            $titleSlug = Str::slug($request->title);
            $pageImageName = $titleSlug . '-page-' . uniqid() . '.webp';
            $pageImage = Image::make($request->file('page_image')->getRealPath());
            $pageImage->encode('webp', 90)->save($destinationPath . '/' . $pageImageName);
            if ($activity->page_image && file_exists($destinationPath . '/' . $activity->page_image)) {
                unlink($destinationPath . '/' . $activity->page_image);
            }
        }
        $activity->update([
            'title' => $request->title,
            'short_content' => $request->short_description,
            'long_content' => $request->content,
            'main_image' => $mainImageName,
            'page_image' => $pageImageName,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
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
        if ($request->has('existing_video_ids')) {
            foreach ($request->existing_video_ids as $videoId) {
                $video = ActivitiesVideo::find($videoId);
                if (!$video) continue;
                $video->title = $request->act_video_title[$videoId] ?? $video->title;
                if ($request->hasFile('activities_video_file') && isset($request->file('activities_video_file')[$videoId])) {
                    $videoFile = $request->file('activities_video_file')[$videoId];
                    $videoFileName = Str::slug($request->title) . '-video-' . uniqid() . '.' . $videoFile->getClientOriginalExtension();
                    
                    $videoDestinationPath = public_path('upload/activities/videos');
                    if (!file_exists($videoDestinationPath)) {
                        mkdir($videoDestinationPath, 0755, true);
                    }
                    if ($video->video_path && file_exists(public_path($video->video_path))) {
                        unlink(public_path($video->video_path));
                    }                    
                    $videoFile->move($videoDestinationPath, $videoFileName);
                    $video->video_path = 'upload/activities/videos/' . $videoFileName;
                    $video->video_link = null; 
                }
                if (isset($request->activities_video_link[$videoId]) && !empty($request->activities_video_link[$videoId])) {
                    $video->video_link = $request->activities_video_link[$videoId];
                    if ($video->video_path && file_exists(public_path($video->video_path))) {
                        unlink(public_path($video->video_path));
                    }
                    $video->video_path = null;
                }                
                $video->save();
            }
        }
        if ($request->has('new_act_video_title')) {
            $newVideoTitles = $request->new_act_video_title;
            $newVideoFiles = $request->file('new_activities_video_file') ?? [];
            $newVideoLinks = $request->new_activities_video_link ?? [];            
            foreach ($newVideoTitles as $index => $title) {
                $currentVideoFile = $newVideoFiles[$index] ?? null;
                $currentVideoLink = $newVideoLinks[$index] ?? null;                
                if (empty($currentVideoFile) && empty($currentVideoLink)) {
                    continue;
                }                
                $videoPath = null;
                $videoLink = null;
                if (!empty($currentVideoFile)) {
                    $videoFileName = Str::slug($request->title) . '-video-' . uniqid() . '.' . $currentVideoFile->getClientOriginalExtension();
                    
                    $videoDestinationPath = public_path('upload/activities/videos');
                    if (!file_exists($videoDestinationPath)) {
                        mkdir($videoDestinationPath, 0755, true);
                    }
                    
                    $currentVideoFile->move($videoDestinationPath, $videoFileName);
                    $videoPath = 'upload/activities/videos/' . $videoFileName;
                }
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

    public function destroy($id)
    {
        try {
            $activity = Activity::with(['images', 'videos'])->findOrFail($id);            
            $destinationPath = public_path('upload/activities');
            $videoDestinationPath = public_path('upload/activities/videos');
            if ($activity->main_image && file_exists($destinationPath . '/' . $activity->main_image)) {
                unlink($destinationPath . '/' . $activity->main_image);
            }
            if ($activity->page_image && file_exists($destinationPath . '/' . $activity->page_image)) {
                unlink($destinationPath . '/' . $activity->page_image);
            }
            foreach ($activity->images as $image) {
                if ($image->image && file_exists($destinationPath . '/' . $image->image)) {
                    unlink($destinationPath . '/' . $image->image);
                }
                $image->delete();
            }
            foreach ($activity->videos as $video) {
                if ($video->video_path && file_exists(public_path($video->video_path))) {
                    unlink(public_path($video->video_path));
                }
                $video->delete(); 
            }
            $activity->delete();            
            return response()->json([
                'status' => 'success',
                'message' => 'Activity deleted successfully!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting activity: ' . $e->getMessage()
            ], 500);
        }
    }

    public function addMoreImages($id)
    {
        $activity = Activity::findOrFail($id);
        $activitiesImages = $activity->images;        
        $form = '
        <div class="modal-body">
            <div class="row" id="activity-images-container">';
                if($activitiesImages->count() > 0){
                    foreach($activitiesImages as $image){
                        $form .= '
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3 image-item" id="image-'.$image->id.'">
                            <div class="card h-100">
                                <img src="'.asset('upload/activities/'.$image->image).'" class="card-img-top" alt="Activity Image" style="height: 120px; object-fit: cover;">
                                <div class="card-body p-2 text-center">
                                    <button class="btn btn-sm btn-danger delete-activity-image" data-image-id="'.$image->id.'"
                                    data-route="'.route('activities-image.destroy', $image->id).'">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    $form .= '
                    <div class="col-12 text-center py-4">
                        <i class="fas fa-image fa-3x text-muted mb-2"></i>
                        <p class="text-muted">No images found for this activity.</p>
                    </div>';
                }
                
                $form .= '
            </div>
            <hr>
            <form method="POST" action="'.route('manage-activities.addMoreImages.submit').'" enctype="multipart/form-data" id="addMoreImagesForm">
                '.csrf_field().'
                <input type="hidden" name="activities_id" value="'.$activity->id.'">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="add_more_activities_image" class="form-label">Add More Images *</label>
                            <input type="file" name="add_more_activities_image[]" multiple class="form-control" id="add_more_activities_image">
                            <div class="form-text">You can select multiple images. Maximum 15 images allowed.</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" form="addMoreImagesForm" class="btn btn-primary">Upload Images</button>
        </div>';
        
        return response()->json([
            'success' => true,
            'message' => 'Form created successfully',
            'form' => $form,
        ]);
    }

    public function addMoreImagesSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activities_id' => 'required|exists:activities,id',
            'add_more_activities_image'   => 'required|array|min:1',
            'add_more_activities_image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ], [
            'add_more_activities_image.required' => 'Please select at least one image.',
            'add_more_activities_image.array'    => 'Invalid image upload format.',
            'add_more_activities_image.min'      => 'Please select at least one image.',
            'add_more_activities_image.*.image'  => 'Each file must be an image.',
            'add_more_activities_image.*.mimes'  => 'Only jpeg, png, jpg, gif, webp formats are allowed.',
            'add_more_activities_image.*.max'    => 'Each image must not be greater than 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            $activity = Activity::with('images')->findOrFail($request->activities_id);
            $currentImageCount = $activity->images->count();
            $newImages = $request->file('add_more_activities_image');            
            $destinationPath = public_path('upload/activities');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $uploadedImages = [];
            $titleSlug = Str::slug($activity->title);
            if ($request->hasFile('add_more_activities_image')) {            
                foreach ($newImages as $index => $image) {
                    $imageName = $titleSlug . '-more-' . uniqid() . '.webp'; 
                    $img = Image::make($image->getRealPath());
                    $img->encode('webp', 90)->save($destinationPath . '/' . $imageName);
                    $activityImage = ActivitiesImage::create([
                        'activities_id' => $activity->id,
                        'title' => $activity->title . ' Additional Image ' . ($currentImageCount + $index + 1),
                        'image' => $imageName,
                        'short_order' => $currentImageCount + $index + 1,
                    ]);
                    
                    $uploadedImages[] = [
                        'id' => $activityImage->id,
                        'url' => asset('upload/activities/' . $imageName)
                    ];
                }
            }            
            return response()->json([
                'success' => true,
                'message' => 'Images uploaded successfully!',
                'images' => $uploadedImages
            ]);            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error uploading images: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyImage($id)
    {
        try {
            $image = ActivitiesImage::findOrFail($id);
            $destinationPath = public_path('upload/activities');
            if ($image->image && file_exists($destinationPath . '/' . $image->image)) {
                unlink($destinationPath . '/' . $image->image);
            }
            $image->delete();            
            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully!'
            ]);            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image: ' . $e->getMessage()
            ], 500);
        }
    }

    public function addMoreVideos($id)
    {
        $activity = Activity::findOrFail($id);
        $activitiesVideos = $activity->videos;  
        $form = '
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Video File</th>
                            <th>Or Video Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="videos-container">';
                    
                    if($activitiesVideos->count() > 0){
                        foreach($activitiesVideos as $video){
                            $form .= '
                            <tr class="video-row" data-video-id="'.$video->id.'">
                                <td>
                                    <input type="text" name="video_title['.$video->id.']" class="form-control form-control-sm" 
                                        value="'.$video->title.'" placeholder="Video Title">
                                </td>
                                <td>
                                    <input type="file" name="video_file['.$video->id.']" class="form-control form-control-sm">
                                    '.($video->video_path ? '<div class="form-text small">Current: '.basename($video->video_path).'</div>' : '').'
                                </td>
                                <td>
                                    <input type="url" name="video_link['.$video->id.']" class="form-control form-control-sm" 
                                        value="'.$video->video_link.'" placeholder="https://example.com/video">
                                </td>
                                <td>
                                    <form action="'.route('activities-vidos.destroy', $video->id).'" method="POST" class="d-inline">
                                    '.csrf_field().'
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger show_confirm_delete_activity_video" 
                                            data-name="Activity" 
                                            data-activity-title="'.$video->title.'">
                                       <i class="fas fa-trash"></i>
                                    </button>
                                    </form>

                                </td>
                            </tr>';
                        }
                    }                    
                    $form .= '
                    </tbody>
                </table>
            </div>        
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>';        
        return response()->json([
            'success' => true,
            'message' => 'Form created successfully',
            'form' => $form,
        ]);
    }

    
    public function destroyVideo($id)
    {
        try {
            $video = ActivitiesVideo::findOrFail($id);
            if ($video->video_path && file_exists(public_path($video->video_path))) {
                unlink(public_path($video->video_path));
            }
            $video->delete();            
            return redirect()->route('manage-activities.index')->with('success', 'Video deleted successfully');            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting video: ' . $e->getMessage()
            ], 500);
        }
    }

}
