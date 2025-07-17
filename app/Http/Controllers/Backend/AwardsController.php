<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\Year;
use App\Models\AwardCategories;
use App\Models\Awards;
use App\Models\AwardsImage;

class AwardsController extends Controller
{
    public function index(){
        $awards = Awards::with(['awardCategory', 'year', 'awardImages'])
                ->latest()
                ->get();
        return view('backend.pages.awards.index', compact('awards'));
    }

    public function create(){
        $data['year'] = Year::where('status', 1)->get();
        $data['awards_categories'] = AwardCategories::where('status', 1)->get();
        return view('backend.pages.awards.create', compact('data'))     ;
    }

    public function store(Request $request){
        $request->validate([
            'awards_category' => 'required|exists:award_categories,id',
            'awards_year' => 'required|exists:years,id',
            'awards_content' => 'nullable|string',
            'awards_img.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        DB::beginTransaction();

        try {
            $award = Awards::create([
                'awards_category_id' => $request->awards_category,
                'year_id' => $request->awards_year,
                'content' => $request->awards_content,
                'status' => $request->has('awards_status') ? 1 : 0,
            ]);
            if ($request->hasFile('awards_img')) {
                $destinationPath = public_path('upload/awards');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                foreach ($request->file('awards_img') as $file) {
                    //$uniqueTimestampDesktop = round(microtime(true) * 1000);
                    $filename = 'awards-' . uniqid() . '-' . time() . '.webp';
                    $imagePath = $destinationPath . '/' . $filename;
                    $image = Image::make($file)
                        ->encode('webp', 75)
                        ->resize(1000, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                    $image->save($imagePath);
                    AwardsImage::create([
                        'awards_id' => $award->id,
                        'file' => $filename,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('manage-awards.index')->with('success', 'Award created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit($id){
        $award = Awards::with(['awardCategory', 'year', 'awardImages'])
                ->findOrFail($id);
        $data['awards_categories'] = AwardCategories::where('status', 1)->get();
        $data['year'] = Year::where('status', 1)->get();
        
        return view('backend.pages.awards.edit', compact('data', 'award'));
    }

    public function update(Request $request, $id)
    {
        $award = Awards::findOrFail($id);
        $request->validate([
            'awards_category' => 'required|exists:award_categories,id',
            'awards_year' => 'required|exists:years,id',
            'awards_content' => 'nullable|string',
            'awards_img.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        DB::beginTransaction();
        try {
            $award->update([
                'awards_category_id' => $request->awards_category,
                'year_id' => $request->awards_year,
                'content' => $request->awards_content,
                'status' => $request->has('awards_status') ? 1 : 0,
            ]);
            if ($request->hasFile('awards_img')) {
                $destinationPath = public_path('upload/awards');                
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true);
                }
                foreach ($request->file('awards_img') as $file) {
                    $filename = 'awards-' . uniqid() . '-' . time() . '.webp';
                    $imagePath = $destinationPath . '/' . $filename;                    
                    $image = Image::make($file)
                    ->encode('webp', 80)
                    ->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });                    
                    $image->save($imagePath);
                    AwardsImage::create([
                        'awards_id' => $award->id,
                        'file' => $filename,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('manage-awards.index')->with('success', 'Award updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Award update failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update award. Please try again.'])
                        ->withInput();
        }
    }

    public function destroy($id){
        $award = Awards::findOrFail($id);
        DB::beginTransaction();
        try {
            foreach ($award->awardImages as $image) {
                $filePath = public_path('upload/awards/' . $image->file);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                $image->delete();
            }
            $award->delete();
            DB::commit();
            return redirect()->route('manage-awards.index')->with('success', 'Award deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Award deletion failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete award. Please try again.']);
        }
    }


}
