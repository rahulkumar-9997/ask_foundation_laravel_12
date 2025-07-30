@extends('backend.layouts.master')
@section('title','Add new Doctor')
@push('styles')
<link rel="stylesheet" href="{{asset('backend/assets/plugins/summernote/summernote-bs4.min.css')}}">
@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold"></h4>
                <h6>
                    Add new Doctor
                </h6>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <a href="{{ route('manage-doctors.index') }}" data-title="Go Back to Previous Page" data-bs-toggle="tooltip" class="btn btn-sm btn-purple" data-bs-original-title="Go Back to Previous Page">
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
            <form action="{{ route('manage-doctors.store') }}" method="POST" enctype="multipart/form-data" id="doctorsFormAdd">
                @csrf
                <div class="row">
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="doctor_name">
                                Doctor name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('doctor_name') is-invalid @enderror" id="doctor_name" name="doctor_name" value="{{ old('doctor_name') }}" />
                            @error('doctor_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="doctor_department">
                                Doctor Department <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('doctor_department') is-invalid @enderror" id="doctor_department" name="doctor_department" value="{{ old('doctor_department') }}">
                            @error('doctor_department')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="doctor_experience">
                                Doctor Experience 
                            </label>
                            <input type="text" class="form-control @error('doctor_experience') is-invalid @enderror" id="doctor_experience" name="doctor_experience" value="{{ old('doctor_experience') }}">
                            @error('doctor_experience')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="work_location">
                                Work Location
                            </label>
                            <input type="text" class="form-control @error('work_location') is-invalid @enderror" id="work_location" name="work_location" value="{{ old('work_location') }}">
                            @error('work_location')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="profile_image">
                                Doctor Profile Image
                            </label>
                            <input type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image" id="profile_image" value="{{ old('profile_image') }}" />
                            @error('profile_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="short_content">
                                Short Content
                            </label>
                            <textarea class="form-control @error('short_content') is-invalid @enderror" id="short_content" name="short_content" rows="2">{{ old('short_content') }}</textarea>
                            @error('short_content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="summer-description-box mb-3">
                            <label class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea id="summernote" name="content" hidden>{{ old('content') }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="summer-description-box mb-3">
                            <label class="form-label">Role in ASK Foundation </label>
                            <textarea class="summernoteClassTwo" name="role_content" hidden>{{ old('role_content') }}</textarea>
                            @error('role_content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
               
                               
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <a href="{{ route('manage-banner.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary" id="submitButton">
                                <span id="submitText">Submit</span>
                            </button>
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