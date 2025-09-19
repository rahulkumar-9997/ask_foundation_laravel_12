@extends('backend.layouts.master')
@section('title','Edit Activities')
@push('styles')
<style>
    .bg-light-danger {
        background-color: rgba(220, 53, 69, 0.1) !important;
    }

    .opacity-50 {
        opacity: 0.5;
    }

    .card-header.bg-indigo {
        background-color: #6610f2 !important;
    }
</style>
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
                                Main Image
                            </label>
                            <input type="file" class="form-control @error('main_image') is-invalid @enderror" name="main_image" id="main_image" />
                            @error('main_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($activity->main_image)
                            <div class="mt-2">
                                <img src="{{ asset('upload/activities/' . $activity->main_image) }}" alt="Main Image" class="img-thumbnail" width="100">
                                <div class="form-text">Current main image</div>
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
                                <div class="form-text">Current page image</div>
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
                                Add More Images (Max 15)
                            </label>
                            <input type="file" class="form-control @error('more_image') is-invalid @enderror" name="more_image[]" id="more_image" multiple />
                            @error('more_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @if($activity->images->count() > 0)
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Existing Additional Images ({{ $activity->images->count() }})</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($activity->images as $image)
                                    <div class="col-md-2 col-sm-2 col-4 mb-3">
                                        <img src="{{ asset('upload/activities/' . $image->image) }}" class="img-thumbnail" alt="Additional Image" style="height: 150px; object-fit: cover;">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Content Editor -->
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

                <!-- Videos Section -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Activities Videos ({{ $activity->videos->count() }})</h5>
                            </div>
                            <div class="card-body">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 25%">Video Title</th>
                                            <th style="width: 65%">Video File Or Youtube Video ID</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="activitiesVideosContainer">
                                        <!-- Existing videos -->
                                        @foreach($activity->videos as $video)
                                        <tr class="activities-video-row">
                                            <td>
                                                <input type="text" name="act_video_title[{{ $video->id }}]" class="form-control form-control-sm" placeholder="Video title" value="{{ old('act_video_title.' . $video->id, $video->title) }}">
                                                <input type="hidden" name="existing_video_ids[]" value="{{ $video->id }}">
                                            </td>
                                            <td>
                                                <div class="mb-2">
                                                    <input type="file" name="activities_video_file[{{ $video->id }}]" class="form-control form-control-sm">
                                                </div>
                                                <div class="text-center text-muted small">OR</div>
                                                <input type="text" name="activities_video_link[{{ $video->id }}]" class="form-control form-control-sm mt-2" placeholder="Video URL" value="{{ old('activities_video_link.' . $video->id, $video->video_link) }}">

                                                @if($video->video_path)
                                                <div class="form-text mt-1">
                                                    <i class="fas fa-video me-1 text-primary"></i>
                                                    Current file: {{ basename($video->video_path) }}
                                                </div>
                                                @elseif($video->video_link)
                                                <div class="form-text mt-1">
                                                    <i class="fas fa-link me-1 text-success"></i>
                                                    Current Youtube video id: {{ $video->video_link }}
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm view-video"
                                                    data-video-path="{{ $video->video_path }}"
                                                    data-video-link="{{ $video->video_link }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="activities-video-row new-video-template d-none">
                                            <td>
                                                <input type="text" name="new_act_video_title[]" class="form-control form-control-sm" placeholder="New video title">
                                            </td>
                                            <td>
                                                <div class="mb-2">
                                                    <input type="file" name="new_activities_video_file[]" class="form-control form-control-sm">
                                                </div>
                                                <div class="text-center text-muted small">OR</div>
                                                <input type="text" name="new_activities_video_link[]" class="form-control form-control-sm mt-2" placeholder="Yourube Video ID">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-video-row">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="activities-video-row new-video-row">
                                            <td>
                                                <input type="text" name="new_act_video_title[]" class="form-control form-control-sm" placeholder="New video title">
                                            </td>
                                            <td>
                                                <div class="mb-2">
                                                    <input type="file" name="new_activities_video_file[]" class="form-control form-control-sm">
                                                </div>
                                                <div class="text-center text-muted small">OR</div>
                                                <input type="text" name="new_activities_video_link[]" class="form-control form-control-sm mt-2" placeholder="Video ID">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-video-row">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="text-end mt-3">
                                    <button class="btn btn-primary add-more-activities-section btn-sm" type="button">
                                        <i class="fas fa-plus me-1"></i> Add More Videos
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <a href="{{ route('manage-activities.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitButton">
                                <i class="fas fa-save me-1"></i> Update Activity
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="videoPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="video-preview-container"></div>
            </div>
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