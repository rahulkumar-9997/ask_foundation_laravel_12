@extends('backend.layouts.master')
@section('title','Add new Activities')
@push('styles')
<!-- <link rel="stylesheet" href="{{asset('backend/assets/plugins/summernote/summernote-bs4.min.css')}}"> -->
@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold"></h4>
                <h6>
                    Add new Activities
                </h6>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <a href="{{ route('manage-activities.index') }}" data-title="Go Back to Previous Page" data-bs-toggle="tooltip" class="btn btn-sm btn-info" data-bs-original-title="Go Back to Previous Page">
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
            <form action="{{ route('manage-activities.store') }}" method="POST" enctype="multipart/form-data" id="activitiesFormAdd">
                @csrf
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="title">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="banner_video_title" name="title" value="{{ old('title') }}" />
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-3 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="short_description">
                                Short Description
                            </label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="2">{{ old('short_description') }}</textarea>
                            @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-sm-3 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="main_image">
                                Main Image <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control @error('main_image') is-invalid @enderror" name="main_image" id="main_image" value="{{ old('main_image') }}" />
                            @error('main_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-3 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="page_image">
                                Page Image 
                            </label>
                            <input type="file" class="form-control @error('page_image') is-invalid @enderror" name="page_image" id="page_image" value="{{ old('page_image') }}" />
                            @error('page_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="meta_title">Meta title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" />
                            @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="meta_description">
                                Meta Description
                            </label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="2">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="more_image">
                                Activities more image (Select image multiple only 15 img)
                            </label>
                            <input type="file" class="form-control @error('more_image') is-invalid @enderror" name="more_image[]" id="more_image" value="{{ old('more_image') }}" multiple />
                            @error('more_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="summer-description-box mb-3">
                            <label class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea id="" name="content" class="ckeditor4">{{ old('content') }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>                
                <div class="row sticky" id="activitiesVideoSection">
                    <div class="col-md-12">
                        <div class="bg-indigo pt-1 pb-1 rounded-2">
                            <h4 class="text-center text-light" style="margin-bottom: 0px;">
                                Activities Videos
                            </h4>
                        </div>
                        <table class="table align-middle mb-3">
                            <thead>
                                <tr>
                                    <th style="width: 25%">Video Title</th>
                                    <th style="width: 25%">Video File Or Video Link</th>
                                </tr>
                            </thead>
                            <tbody id="activitiesVideosContainer">
                                <tr class="activities-video-row">
                                    <td style="width: 25%">
                                        <input type="text" name="act_video_title[]" class="form-control" placeholder="Enter activities video title">
                                    </td>
                                    <td style="width: 25%; text-align: center;">
                                        <input type="file" name="activities_video_file[]" class="form-control">
                                        <span class="text-center text-success">OR</span>
                                        <input type="text" name="activities_video_link[]" class="form-control" placeholder="Enter activities video link">
                                    </td>                                    
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end">
                                        <button class="btn btn-primary add-more-activities-section btn-sm" type="button">Add More activities Video</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
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
<script src="{{ asset('backend/assets/js/pages/activities.js') }}"></script>
<script src="{{ asset('backend/assets/ckeditor-4/ckeditor.js') }}"></script>
<script>
    document.querySelectorAll('.ckeditor4').forEach(function(el) {
        CKEDITOR.replace(el, {
            removePlugins: 'exportpdf'
        });
    });    
</script>
@endpush