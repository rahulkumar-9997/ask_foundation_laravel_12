<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Year;


class YearController extends Controller
{
    public function index(){
        $years = Year::orderBy('id', 'desc')->get();
        return view('backend.pages.year.index', compact('years'));
    }

    public function create(Request $request){
        $token = $request->input('_token'); 
        $size = $request->input('size'); 
        $url = $request->input('url'); 
        $form ='
        <div class="modal-body">
            <form method="POST" action="'.route('manage-year.store').'" accept-charset="UTF-8" enctype="multipart/form-data" id="yearAddForm">
                '.csrf_field().'
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="year_name" class="form-label">Year Name *</label>
                            <input type="text" name="year_name" class="form-control" id="year_name" placeholder="2025">
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
            'year_name' => 'required|string|max:255|unique:years,title',
        ], [
            'year_name.required' => 'The year name field is required.',
            'year_name.unique' => 'This year already exists.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            $year = Year::create([
                'title' => $request->year_name,
                'status' => 1,
            ]);
            $years = Year::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Year created successfully!',
                'yearData' => view('backend.pages.year.partials.year-list', compact('years'))->render(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again.'
            ], 500);
        }
    }

    public function edit(Request $request, $id){
        $yearId = $request->input('yearId');
        $year_row = Year::findOrFail($yearId); 
        $form ='
        <div class="modal-body">
            <form method="POST" action="'.route('manage-year.update', $id).'" accept-charset="UTF-8" enctype="multipart/form-data" id="yearEditForm">
                '.csrf_field().'
                '.method_field('PUT').'
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="year_name" class="form-label">Year Name *</label>
                            <input type="text" name="year_name" class="form-control" id="year_name" placeholder="2025" value="'.$year_row->title.'">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="edit_status" name="status" 
                                    value="1" '.($year_row->status == 1 ? 'checked' : '').'>
                                <label class="form-check-label" for="edit_status">
                                    '.($year_row->status == 1 ? 'Active' : 'Inactive').'
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
            'year_name' => 'required|string|max:255|unique:years,title,'.$id,
            'status' => 'sometimes|boolean',
        ], [
            'year_name.required' => 'The year name field is required.',
            'year_name.unique' => 'This year already exists.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $year = Year::findOrFail($id);
            $year->update([
                'title' => $request->year_name,
                'status' => $request->status ?? 0,
            ]);
            $years = Year::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Year updated successfully!',
                'yearData' => view('backend.pages.year.partials.year-list', compact('years'))->render()
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
            $year = Year::findOrFail($id);
            $year->delete();
            DB::commit();
            return redirect()->route('manage-year.index')->with('success', 'Year deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete year: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete year. Please try again.');
        }
    }

}
