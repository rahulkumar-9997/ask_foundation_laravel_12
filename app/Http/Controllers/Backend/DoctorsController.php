<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Doctors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class DoctorsController extends Controller
{
    public function index(){
        $doctors = Doctors::orderBy('id', 'desc')->paginate(20);
        return view('backend.pages.doctors.index', compact('doctors'));
    }

    public function create(){       
        return view('backend.pages.doctors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'doctor_name' => 'required|string|max:255',
            'doctor_department' => 'required|string|max:255',
            'doctor_experience' => 'nullable|string|max:255',
            'work_location' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'short_content' => 'nullable|string',
            'content' => 'required|string',
            'role_content' => 'nullable|string',
        ]);
        DB::beginTransaction();
        try {
            $imageName = null;
            if ($request->hasFile('profile_image')) {
                $destinationPath = public_path('upload/doctors');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }                
                $safeTitle = Str::slug($request->doctor_name);
                $imageFile = $request->file('profile_image');
                $uniqueTimestamp = round(microtime(true) * 1000);
                $imageName = $safeTitle . '-' . $uniqueTimestamp . '.webp';
                
                $image = Image::make($imageFile);
                $image->encode('webp', 75);
                $image->save($destinationPath . '/' . $imageName);
            }            
            $doctor = Doctors::create([
                'doctor_name' => $validatedData['doctor_name'],
                'department' => $validatedData['doctor_department'],
                'experience' => $validatedData['doctor_experience'],
                'work_location' => $validatedData['work_location'],
                'short_content' => $validatedData['short_content'],
                'image' => $imageName,
                'content' => $validatedData['content'],
                'role_in_ask_foundation' => $validatedData['role_content'],
                'status' => 1, 
            ]);            
            DB::commit();
            return redirect()->route('manage-doctors.index')->with('success', 'Doctor created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($imageName) && $imageName) {
                $imagePath = public_path('upload/doctors/' . $imageName);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            Log::error('Doctor creation failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to create doctor. Please try again. Error: ' . $e->getMessage());
        }
    }
    
    public function edit($id){  
        $doctor = Doctors::findOrFail($id);     
        return view('backend.pages.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'doctor_name' => 'required|string|max:255',
            'doctor_department' => 'required|string|max:255',
            'doctor_experience' => 'nullable|string|max:255',
            'work_location' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'short_content' => 'nullable|string',
            'content' => 'required|string',
            'role_content' => 'nullable|string',
        ]);
        DB::beginTransaction();
        try {
            $doctor = Doctors::findOrFail($id);
            $imageName = $doctor->image;
            if ($request->has('remove_image')) {
                if ($imageName) {
                    $imagePath = public_path('upload/doctors/' . $imageName);
                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }
                }
                $imageName = null;
            }
            if ($request->hasFile('profile_image')) {
                $destinationPath = public_path('upload/doctors');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                if ($imageName) {
                    $oldImagePath = public_path('upload/doctors/' . $imageName);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }
                $safeTitle = Str::slug($request->doctor_name);
                $uniqueTimestamp = round(microtime(true) * 1000);
                $imageName = $safeTitle . '-' . $uniqueTimestamp . '.webp';
                
                $image = Image::make($request->file('profile_image'));
                $image->encode('webp', 75);
                $image->save($destinationPath . '/' . $imageName);
            }
            $doctor->update([
                'doctor_name' => $validatedData['doctor_name'],
                'department' => $validatedData['doctor_department'],
                'experience' => $validatedData['doctor_experience'],
                'work_location' => $validatedData['work_location'],
                'short_content' => $validatedData['short_content'],
                'image' => $imageName,
                'content' => $validatedData['content'],
                'role_in_ask_foundation' => $validatedData['role_content'],
            ]);
            DB::commit();
            return redirect()->route('manage-doctors.index')->with('success', 'Doctor updated successfully.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            Log::error('Doctor not found: ' . $e->getMessage());
            return redirect()->route('manage-doctors.index')->with('error', 'Doctor not found.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Doctor update failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update doctor. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $doctor = Doctors::findOrFail($id); 
            if ($doctor->image) {
                $imagePath = public_path('upload/doctors/' . $doctor->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            $doctor->delete();            
            DB::commit();            
            return redirect()->route('manage-doctors.index')->with('success', 'Doctor deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Doctor deletion failed: ' . $e->getMessage());
            return redirect()->route('manage-doctors.index')->with('error', 'Failed to delete doctor. Please try again.' .$e->getMessage());
        }
    }
}
