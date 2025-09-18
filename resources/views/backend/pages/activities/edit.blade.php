@extends('backend.layouts.master')
@section('title','Edit Activities')
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
                    Edit Activities
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
            <form action="{{ route('manage-activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data" id="activitiesFormEdit">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="title">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="banner_video_title" name="title" value="{{ old('title', $activity->title) }}" />
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
                            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="2">{{ old('short_description', $activity->short_content) }}</textarea>
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
                            <input type="file" class="form-control @error('main_image') is-invalid @enderror" name="main_image" id="main_image" />
                            @error('main_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($activity->main_image)
                            <div class="mt-2">
                                <img src="{{ asset('upload/activities/' . $activity->main_image) }}" alt="Main Image" class="img-thumbnail" width="100">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remove_main_image" id="remove_main_image" value="1">
                                    <label class="form-check-label" for="remove_main_image">
                                        Remove current image
                                    </label>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="page_image">
                                Page Image
                            </label>
                            <input type="file" class="form-control @error('page_image') is-invalid @enderror" name="page_image" id="page_image" />
                            @error('page_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($activity->page_image)
                            <div class="mt-2">
                                <img src="{{ asset('upload/activities/' . $activity->page_image) }}" alt="Page Image" class="img-thumbnail" width="100">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remove_page_image" id="remove_page_image" value="1">
                                    <label class="form-check-label" for="remove_page_image">
                                        Remove current image
                                    </label>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="meta_title">Meta title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title" value="{{ old('meta_title', $activity->meta_title) }}" />
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
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="2">{{ old('meta_description', $activity->meta_description) }}</textarea>
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
                            <input type="file" class="form-control @error('more_image') is-invalid @enderror" name="more_image[]" id="more_image" multiple />
                            @error('more_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <!-- Display existing additional images -->
                            @if($activity->images->count() > 0)
                            <div class="mt-2">
                                <h6>Existing Additional Images:</h6>
                                <div class="d-flex flex-wrap">
                                    @foreach($activity->images as $image)
                                    <div class="position-relative me-2 mb-2">
                                        <img src="{{ asset('upload/activities/' . $image->image) }}" alt="Additional Image" class="img-thumbnail" width="80">
                                        <div class="form-check position-absolute top-0 end-0">
                                            <input class="form-check-input" type="checkbox" name="remove_images[]" value="{{ $image->id }}">
                                            <label class="form-check-label text-white bg-danger rounded-circle px-1">×</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="summer-description-box mb-3">
                            <label class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea id="content" name="content" class="ckeditor4">{{ old('content', $activity->long_content) }}</textarea>
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
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="activitiesVideosContainer">
                                <!-- Existing videos -->
                                @foreach($activity->videos as $index => $video)
                                <tr class="activities-video-row">
                                    <td style="width: 25%">
                                        <input type="text" name="act_video_title[{{ $video->id }}]" class="form-control" placeholder="Enter activities video title" value="{{ old('act_video_title.' . $video->id, $video->title) }}">
                                        <input type="hidden" name="existing_video_ids[]" value="{{ $video->id }}">
                                    </td>
                                    <td style="width: 25%; text-align: center;">
                                        <input type="file" name="activities_video_file[{{ $video->id }}]" class="form-control">
                                        <span class="text-center text-success">OR</span>
                                        <input type="text" name="activities_video_link[{{ $video->id }}]" class="form-control" placeholder="Enter activities video link" value="{{ old('activities_video_link.' . $video->id, $video->video_link) }}">

                                        @if($video->video_path)
                                        <div class="mt-2">
                                            <small>Current video: {{ basename($video->video_path) }}</small>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remove_video_files[]" value="{{ $video->id }}">
                                                <label class="form-check-label">
                                                    Remove current video file
                                                </label>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td style="width: 10%">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remove_videos[]" value="{{ $video->id }}">
                                            <label class="form-check-label">
                                                Delete
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                <!-- New video row template -->
                                <tr class="activities-video-row new-video-template d-none">
                                    <td style="width: 25%">
                                        <input type="text" name="new_act_video_title[]" class="form-control" placeholder="Enter activities video title">
                                    </td>
                                    <td style="width: 25%; text-align: center;">
                                        <input type="file" name="new_activities_video_file[]" class="form-control">
                                        <span class="text-center text-success">OR</span>
                                        <input type="text" name="new_activities_video_link[]" class="form-control" placeholder="Enter activities video link">
                                    </td>
                                    <td style="width: 10%">
                                        <button type="button" class="btn btn-danger btn-sm remove-video-row">Remove</button>
                                    </td>
                                </tr>

                                <!-- Empty row for adding new videos -->
                                <tr class="activities-video-row new-video-row">
                                    <td style="width: 25%">
                                        <input type="text" name="new_act_video_title[]" class="form-control" placeholder="Enter activities video title">
                                    </td>
                                    <td style="width: 25%; text-align: center;">
                                        <input type="file" name="new_activities_video_file[]" class="form-control">
                                        <span class="text-center text-success">OR</span>
                                        <input type="text" name="new_activities_video_link[]" class="form-control" placeholder="Enter activities video link">
                                    </td>
                                    <td style="width: 10%">
                                        <button type="button" class="btn btn-danger btn-sm remove-video-row">Remove</button>
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
                            <a href="{{ route('manage-activities.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary" id="submitButton">
                                <span id="submitText">Update</span>
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