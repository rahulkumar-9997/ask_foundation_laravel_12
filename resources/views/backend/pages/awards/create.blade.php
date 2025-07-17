@extends('backend.layouts.master')
@section('title','Add new Awatds')
@push('styles')
<link rel="stylesheet" href="{{asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/plugins/tabler-icons/tabler-icons.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.bootstrap5.min.css')}}">
@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold"></h4>
                <h6>
                    Add new Awatds
                </h6>                           
            </div>
        </div>
        
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <a href="{{ route('manage-awards.index') }}" data-title="Go Back to Previous Page" data-bs-toggle="tooltip" class="btn btn-sm btn-info" data-bs-original-title="Go Back to Previous Page">
                <i class="ti ti-arrow-left me-1"></i>
                Go Back to Previous Page
            </a>   
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('manage-awards.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label for="awards_category" class="col-form-label">Select Awards Category *</label>
                            <div class="aw-cate">
                                <select class="form-select" name="awards_category" id="awards_category">
                                    <option>-- Select --</option>
                                    @if(isset($data['awards_categories']) && $data['awards_categories']->count() > 0)
                                        @foreach ($data['awards_categories'] as $awards_category)
                                            <option 
                                            value="{{ $awards_category->id }}"
                                            {{ old('awards_category') == $awards_category->id ? 'selected' : '' }}
                                            >
                                            {{ $awards_category->title }}
                                        </option>
                                        @endforeach                                        
                                    @endif
                                </select>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label for="awards_year" class="col-form-label">Select Awards Year *</label>
                            <div class="year">
                                <select class="form-select" name="awards_year" id="awards_year">
                                    <option>-- Select --</option>
                                    @if(isset($data['year']) && $data['year']->count() > 0)
                                        @foreach ($data['year'] as $year)
                                            <option 
                                                value="{{ $year->id }}"
                                                {{ old('awards_year') == $year->id ? 'selected' : '' }}
                                                >
                                                {{ $year->title }}
                                            </option>
                                        @endforeach                                        
                                    @endif
                                </select>

                            </div>
                        </div>                        
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="awards_content">Awards Content</label>
                            <textarea type="text" class="form-control" name="awards_content" id="awards_content">{{ old('awards_content') }}</textarea>
                        </div>
                    </div>
                   
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label" for="awards_status">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="awards_status" name="awards_status" value="1" {{ old('awards_status', 1) ? 'checked' : '' }}>                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="awards_img">Awards Image</label>
                            <input type="file" class="form-control" name="awards_img[]" multiple="" id="awards_img">
                        </div>
                    </div>
                                      
                </div>                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <a href="{{ route('manage-awards.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')

@endpush