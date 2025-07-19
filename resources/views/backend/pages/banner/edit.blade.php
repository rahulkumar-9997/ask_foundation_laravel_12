@extends('backend.layouts.master')
@section('title','Edit banner')
@push('styles')
@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold"></h4>
                <h6>
                    Edit Banner
                </h6>
            </div>
        </div>

    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <a href="{{ route('manage-banner.index') }}" data-title="Go Back to Previous Page" data-bs-toggle="tooltip" class="btn btn-sm btn-info" data-bs-original-title="Go Back to Previous Page">
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
            <form action="{{ route('manage-banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data" id="bannerFormUpdate">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="banner_video_title">
                                Banner video title
                            </label>
                            <input type="text" class="form-control @error('banner_video_title') is-invalid @enderror" id="banner_video_title" name="banner_video_title" value="{{ old('banner_video_title', $banner->title) }}" />
                            @error('banner_video_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="banner_video_subtitle">
                                Banner video sub-title
                            </label>
                            <input type="text" class="form-control @error('banner_video_subtitle') is-invalid @enderror" id="banner_video_subtitle" name="banner_video_subtitle" value="{{ old('banner_video_subtitle', $banner->subtitle) }}" />
                            @error('banner_video_subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="banner_description">
                                Banner video description
                            </label>
                            <textarea class="form-control @error('banner_description') is-invalid @enderror" id="banner_description" name="banner_description" rows="2">
                            {{ old('banner_description', $banner->description) }}
                            </textarea>
                            @error('banner_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="banner_button_link">Button Link </label>
                            <input type="text" class="form-control @error('banner_button_link') is-invalid @enderror" name="banner_button_link" id="banner_button_link" value="{{ old('banner_button_link', $banner->button_link) }}" />
                            @error('banner_button_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="button_popup_url">Button popup url</label>
                            <input type="text" class="form-control @error('button_popup_url') is-invalid @enderror" name="button_popup_url" id="button_popup_url" value="{{ old('button_popup_url', $banner->video_popup_url) }}" />
                            @error('button_popup_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="desktop_video_file">Desktop video file <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('desktop_video_file') is-invalid @enderror" name="desktop_video_file" id="desktop_video_file" accept="video/*">

                            <small class="form-text text-muted">Supported formats: MP4, AVI, MOV. Max size: 50MB</small>
                            @if($banner->desktop_video_url)
                            <div class="mt-2">
                                <small>Current file: {{ basename($banner->desktop_video_url) }}</small>
                                <a href="{{ asset('upload/banner/'.basename($banner->desktop_video_url)) }}" target="_blank" class="ms-2">View</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="mobile_video_file">Mobile video file <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('mobile_video_file') is-invalid @enderror" name="mobile_video_file" id="mobile_video_file">

                            <small class="form-text text-muted">Supported formats: MP4, AVI, MOV. Max size: 50MB</small>
                            @if($banner->mobile_video_url)
                            <div class="mt-2">
                                <small>Current file: {{ basename($banner->mobile_video_url) }}</small>
                                <a href="{{ asset('upload/banner/'.basename($banner->mobile_video_url)) }}" target="_blank" class="ms-2">View</a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Video Features</label>
                            <div id="features-container">
                                @foreach(old('video_features', $banner->features ?? []) as $index => $feature)
                                <div class="input-group mb-2">
                                    <input type="text" name="video_features[]" class="form-control"
                                        value="{{ $feature }}" placeholder="Enter feature">
                                    <button class="btn btn-outline-danger remove-feature" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="add-feature">
                                <i class="fas fa-plus"></i> Add Feature
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <a href="{{ route('manage-banner.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary" id="submitButton">
                                <span id="submitText">Update</span>
                                <div id="uploadProgress" class="spinner-border spinner-border-sm d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                        <div class="progress mb-3 d-none" id="progressBarContainer">
                            <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated"
                                role="progressbar" style="width: 0%"></div>
                        </div>
                        <div id="uploadStatus" class="text-center small"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        /*Add more feature and remove feature */
        const container = $('#features-container');
        const addButton = $('#add-feature');
        addButton.on('click', function() {
            const newFeature = `
            <div class="input-group mb-2">
                <input type="text" name="video_features[]" class="form-control" 
                       placeholder="Enter feature">
                <button class="btn btn-outline-danger remove-feature" type="button">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
            container.append(newFeature);
        });
        container.on('click', '.remove-feature', function(e) {
            const inputGroup = $(this).closest('.input-group');
            if (container.children().length > 1) {
                inputGroup.remove();
            } else {
                alert('At least one feature is required.');
            }
        });
        /*Add more feature and remove feature */
        /*Add banner form submit code */
        $(document).off('submit', '#bannerFormUpdate').on('submit', '#bannerFormUpdate', function(event) {
            event.preventDefault();
            var form = $(this);
            var submitButton = form.find('button[type="submit"]');
            var submitText = $('#submitText');
            var uploadProgress = $('#uploadProgress');
            var progressBarContainer = $('#progressBarContainer');
            var progressBar = $('#progressBar');
            var uploadStatus = $('#uploadStatus');
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            var desktopFile = $('#desktop_video_file')[0].files[0];
            var mobileFile = $('#mobile_video_file')[0].files[0];
            var hasFilesToUpload = desktopFile || mobileFile;
            submitButton.prop('disabled', true);
            submitText.text(hasFilesToUpload ? 'Uploading...' : 'Saving...');
            if (hasFilesToUpload) {
                uploadProgress.removeClass('d-none');
                progressBarContainer.removeClass('d-none');
            } else {
                uploadProgress.addClass('d-none');
                progressBarContainer.addClass('d-none');
            }
            var formData = new FormData(this);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    if (hasFilesToUpload) {
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                var percentComplete = Math.round((e.loaded / e.total) * 100);
                                progressBar.css('width', percentComplete + '%');
                                progressBar.attr('aria-valuenow', percentComplete);
                                uploadStatus.text('Uploading: ' + percentComplete + '%');
                            }
                        }, false);
                    }
                    return xhr;
                },
                success: function(response) {
                    submitButton.prop('disabled', false);
                    submitText.text('Submit');
                    uploadProgress.addClass('d-none');
                    progressBarContainer.addClass('d-none');
                    if (response.status === true) {
                        Toastify({
                            text: response.message || 'Banner video created successfully!',
                            duration: 10000,
                            gravity: "top",
                            position: "right",
                            className: "bg-success",
                            escapeMarkup: false,
                            close: true,
                            onClick: function() {}
                        }).showToast();
                        setTimeout(function() {
                            window.location.href = "{{ route('manage-banner.index') }}";
                        }, 1500);
                    }
                },
                error: function(xhr, status, error) {
                    submitButton.prop('disabled', false);
                    submitText.text('Submit');
                    uploadProgress.addClass('d-none');
                    progressBarContainer.addClass('d-none');
                    var errors = xhr.responseJSON && xhr.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function(key, value) {
                            var inputField = $('[name="' + key + '"]');
                            inputField.addClass('is-invalid');
                            inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                        });
                    } else {
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                            xhr.responseJSON.message :
                            'Error processing request. Please try again.';

                        Toastify({
                            text: errorMessage,
                            duration: 10000,
                            gravity: "top",
                            position: "right",
                            className: "bg-danger",
                            escapeMarkup: false,
                            close: true,
                            onClick: function() {}
                        }).showToast();
                    }
                }
            });
        });
    });
</script>
@endpush