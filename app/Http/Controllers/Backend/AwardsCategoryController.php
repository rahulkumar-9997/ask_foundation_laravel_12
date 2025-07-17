<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\AwardCategories;


class AwardsCategoryController extends Controller
{
    public function index(){
        $awardCategory = AwardCategories::orderBy('id', 'desc')->get();
        return view('backend.pages.award-category.index', compact('awardCategory'));
    }

    public function create(Request $request){
        $url = $request->input('url'); 
        $form ='
        <div class="modal-body">
            <form method="POST" action="'.route('manage-award-category.store').'" accept-charset="UTF-8" enctype="multipart/form-data" id="awardsCategoryAddForm">
                '.csrf_field().'
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="awards_category_name" class="form-label">Awards Category Name *</label>
                            <input type="text" name="awards_category_name" class="form-control" id="awards_category_name">
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
        $validator = Validator::make($request->all(), [
            'awards_category_name' => 'required|string|max:255|unique:award_categories,title',
        ], [
            'awards_category_name.required' => 'The awards category name field is required.',
            'awards_category_name.unique' => 'This awards category already exists.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            $AwardCategories = AwardCategories::create([
                'title' => $request->awards_category_name,
                'status' => 1,
            ]);
            $awardCategory = AwardCategories::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Award category created successfully!',
                'awardCategory' => view('backend.pages.award-category.partials.award-category-list', compact('awardCategory'))->render(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(Request $request, $id){
        $award_category_row = AwardCategories::findOrFail($id); 
        $form ='
        <div class="modal-body">
            <form method="POST" action="'.route('manage-award-category.update', $id).'" accept-charset="UTF-8" enctype="multipart/form-data" id="awardsCategoryEditForm">
                '.csrf_field().'
                '.method_field('PUT').'
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="awards_category_name" class="form-label">Awards Category Name *</label>
                            <input type="text" name="awards_category_name" class="form-control" id="awards_category_name" value="'.$award_category_row->title.'">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="edit_status" name="status" 
                                    value="1" '.($award_category_row->status == 1 ? 'checked' : '').'>
                                <label class="form-check-label" for="edit_status">
                                    '.($award_category_row->status == 1 ? 'Active' : 'Inactive').'
                                </label>
                            </div>
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
        $validator = Validator::make($request->all(), [
            'awards_category_name' => 'required|string|max:255|unique:award_categories,title,'.$id,
            'status' => 'sometimes|boolean',
        ], [
            'awards_category_name.required' => 'The awards category name field is required.',
            'awards_category_name.unique' => 'This awards category already exists.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $awardCategories = AwardCategories::findOrFail($id);
            $awardCategories->update([
                'title' => $request->awards_category_name,
                'status' => $request->status ?? 0,
            ]);
            $awardCategory = AwardCategories::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Award category updated successfully!',
                'awardCategory' => view('backend.pages.award-category.partials.award-category-list', compact('awardCategory'))->render(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again.'
            ], 500);
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try {
            $awardsCategory = AwardCategories::findOrFail($id);
            $awardsCategory->delete();
            DB::commit();
            return redirect()->route('manage-award-category.index')->with('success', 'Award category deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete year: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete award category. Please try again.');
        }
    }
}
