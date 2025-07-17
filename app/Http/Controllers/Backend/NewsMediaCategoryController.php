<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Models\NewsAndMediaCategory;

class NewsMediaCategoryController extends Controller
{
    public function index(){
        $newsMediaCategories = NewsAndMediaCategory::orderBy('id', 'desc')->get();
        return view('backend.pages.new-media-category.index', compact('newsMediaCategories'));
    }

    public function create(Request $request){
        $token = $request->input('_token'); 
        $size = $request->input('size'); 
        $url = $request->input('url'); 
        $form ='
        <div class="modal-body">
            <form method="POST" action="'.route('manage-news-media-category.store').'" accept-charset="UTF-8" enctype="multipart/form-data" id="addNewsMediaCatFrm">
                '.csrf_field().'
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="news_media_title" class="form-label">News & Media Title *</label>
                            <input type="text" name="news_media_title" class="form-control" id="news_media_title">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="news_media_image" class="form-label">News & Media Image File</label>
                            <input type="file" name="news_media_image" class="form-control" id="news_media_image">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="news_media_content" class="form-label">News & Media Content *</label>
                            <textarea class="form-control bg-light-subtle" id="news_media_content" rows="4" name="news_media_content" placeholder="News & Media Content"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer pb-0 pe-2">
                        <button type="button" class="btn btn-cancel waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>                    
                </div>
            </form>
        </div>
        ';
        return response()->json([
            'message' => 'Form created successfully',
            'form' => $form,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'news_media_title' => 'required|string|max:255',
            'news_media_content' => 'required|string',
            'news_media_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        DB::beginTransaction();
        try {
            $imageName = null;
            if ($request->hasFile('news_media_image')) {
                $destinationPath = public_path('upload/newsmediacat');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                $imageFile = $request->file('news_media_image');
                $uniqueTimestamp = round(microtime(true) * 1000);
                $imageName = 'news-media-' . $uniqueTimestamp . '.webp';
                $image = Image::make($imageFile);
                $image->encode('webp', 75);
                $image->save($destinationPath . '/' . $imageName);
            }
            $category = NewsAndMediaCategory::create([
                'title' => $request->news_media_title,
                'description' => $request->news_media_content,
                'file' => $imageName,
                'status' => 1,
            ]);
            DB::commit();
            $newsMediaCategories = NewsAndMediaCategory::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'News & Media category created successfully!',
                'newsAndMediaData' => view('backend.pages.new-media-category.partials.news-media-category-list', compact('newsMediaCategories'))->render(),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create category: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Request $request, $id){
        $newsMediaCategory = NewsAndMediaCategory::findOrFail($id);
        $image_file ='';
        if($newsMediaCategory->file)
        {
            $imagePath = public_path('upload/newsmediacat/' . $newsMediaCategory->file);
            $imageExists = file_exists($imagePath);
            if($imageExists)
            {
                $image_file ='
                <div style="width: 100px; height: 70px; display: flex; justify-content: center; align-items: center; background: #f8f9fa;">
                    <img src="'.asset('upload/newsmediacat/' . $newsMediaCategory->file).'" 
                        style="max-width: 100%; max-height: 100%; object-fit: contain;"
                        alt="'.$newsMediaCategory->title.'"
                        title="'.$newsMediaCategory->title.'">
                </div>';
            }
        }
        $form ='
        <div class="modal-body">
            <form method="POST" action="'.route('manage-news-media-category.update', $newsMediaCategory->id).'" accept-charset="UTF-8" enctype="multipart/form-data" id="editNewsMediaCatFrm">
                '.csrf_field().'
                '.method_field('PUT').'
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="news_media_title" class="form-label">News & Media Title *</label>
                            <input type="text" name="news_media_title" class="form-control" id="news_media_title" value="'.$newsMediaCategory->title.'">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="news_media_image" class="form-label">News & Media Image File</label>
                            <input type="file" name="news_media_image" class="form-control" id="news_media_image">
                        </div>
                        '.$image_file.'
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="news_media_content" class="form-label">News & Media Content *</label>
                            <textarea class="form-control bg-light-subtle" id="news_media_content" rows="4" name="news_media_content" placeholder="News & Media Content">'.$newsMediaCategory->description.'</textarea>
                        </div>
                    </div>
                    <div class="modal-footer pb-0 pe-2">
                        <button type="button" class="btn btn-cancel waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                    </div>                    
                </div>
            </form>
        </div>
        ';
        return response()->json([
            'message' => 'Form created successfully',
            'form' => $form,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'news_media_title' => 'required|string|max:255',
            'news_media_content' => 'required|string',
            'news_media_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        DB::beginTransaction();
        try {
            $newsMediaCategory = NewsAndMediaCategory::findOrFail($id);
            $imageName = $newsMediaCategory->file;
            if ($request->hasFile('news_media_image')) {
                $destinationPath = public_path('upload/newsmediacat');
                if ($newsMediaCategory->file && File::exists($destinationPath . '/' . $newsMediaCategory->file)) {
                    File::delete($destinationPath . '/' . $newsMediaCategory->file);
                }
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                $imageFile = $request->file('news_media_image');
                $uniqueTimestamp = round(microtime(true) * 1000);
                $imageName = 'news-media-' . $uniqueTimestamp . '.webp';                
                $image = Image::make($imageFile);
                $image->encode('webp', 75);
                $image->save($destinationPath . '/' . $imageName);
            }
            $newsMediaCategory->update([
                'title' => $request->news_media_title,
                'description' => $request->news_media_content,
                'file' => $imageName,
            ]);
            DB::commit();
            $newsMediaCategories = NewsAndMediaCategory::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'News & Media category updated successfully!',
                'newsAndMediaData' => view('backend.pages.new-media-category.partials.news-media-category-list', compact('newsMediaCategories'))->render(),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update category: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try {
            $category = NewsAndMediaCategory::findOrFail($id);
            if ($category->file) {
                $imagePath = public_path('upload/newsmediacat/' . $category->file);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            $category->delete();
            DB::commit();
            return redirect()->route('manage-news-media-category.index')
            ->with('success', 'News & Media category deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete category: ' . $e->getMessage()
            ], 500);
        }
    }
}
