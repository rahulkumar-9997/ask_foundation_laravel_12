
$(function () {
    $(document).on("click", ".add-more-activities-section", function() {
        let newRow = `
            <tr class="activities-video-row">
                <td style="width: 25%">
                    <input type="text" name="act_video_title[]" class="form-control" placeholder="Enter activities video title">
                </td>
                <td style="width: 25%; text-align: center;">
                    <input type="file" name="activities_video_file[]" class="form-control mb-1">
                    <span class="text-center text-success d-block mb-1">OR</span>
                    <input type="text" name="activities_video_link[]" class="form-control" placeholder="Enter activities youtube video ID">
                </td>
                <td style="width: 10%; text-align:center;">
                    <button type="button" class="btn btn-danger btn-sm remove-activities-section">
                        Remove
                    </button>
                </td>
            </tr>
        `;
        $("#activitiesVideosContainer").append(newRow);
    });
    $(document).on("click", ".remove-activities-section", function() {
        $(this).closest("tr").remove();
    });

    $(document).off('submit', '#activitiesFormAdd').on('submit', '#activitiesFormAdd', function (event) {
        event.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        submitButton.prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...'
        );
        var formData = new FormData(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                submitButton.prop('disabled', false).html('Submit');
                if (response.status === 'success') {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-success",
                        close: true
                    }).showToast();
                    setTimeout(function () {
                        window.location.href = response.redirect_url;
                    }, 300);
                }
            },
            error: function (xhr) {
                submitButton.prop('disabled', false).html('Submit');
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    Toastify({
                        text: xhr.responseJSON.message,
                        duration: 10000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger",
                        close: true
                    }).showToast();
                }

                var errors = xhr.responseJSON.errors;
                if (errors) {
                    let firstErrorField = null;
                    $.each(errors, function (key, value) {
                        var inputField = $('[name="' + key + '"]'); 
                        inputField.addClass('is-invalid');
                        inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                        if (!firstErrorField) {
                            firstErrorField = inputField;
                        }
                    });
                    if (firstErrorField) {
                        firstErrorField.focus();
                    }
                }
            }
        });
    });

    $(document).off('submit', '#activitiesFormEdit').on('submit', '#activitiesFormEdit', function (event) {
        event.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        submitButton.prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...'
        );
        var formData = new FormData(this);
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                submitButton.prop('disabled', false).html('Update');
                if (response.status === 'success') {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-success",
                        close: true
                    }).showToast();
                    setTimeout(function () {
                        window.location.href = response.redirect_url;
                    }, 300);
                }
            },
            error: function (xhr) {
                submitButton.prop('disabled', false).html('Update');
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    Toastify({
                        text: xhr.responseJSON.message,
                        duration: 10000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger",
                        close: true
                    }).showToast();
                }

                var errors = xhr.responseJSON.errors;
                if (errors) {
                    let firstErrorField = null;
                    $.each(errors, function (key, value) {
                        var inputField = $('[name="' + key + '"]'); 
                        inputField.addClass('is-invalid');
                        inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                        if (!firstErrorField) {
                            firstErrorField = inputField;
                        }
                    });
                    if (firstErrorField) {
                        firstErrorField.focus();
                    }
                }
            }
        });
    });

    $(document).on('click', '.remove-video-row', function() {
        if ($('.activities-video-row').length > 1) {
            $(this).closest('.activities-video-row').remove();
        } else {
            alert('You need at least one video section.');
        }
    });

    $(document).on('click', '.view-video', function(e) {
        e.preventDefault();
        const videoPath = $(this).data('video-path');
        const videoId = $(this).data('video-link');
        let videoHtml = '';

        if (videoPath) {
            videoHtml = `<video controls width="100%">
                <source src="{{ asset('') }}${videoPath}" type="video/mp4">
                Your browser does not support the video tag.
            </video>`;
        } else if (videoId) {
            videoHtml = `<iframe width="100%" height="400" 
                src="https://www.youtube.com/embed/${videoId}" 
                frameborder="0" allowfullscreen></iframe>`;
        } else {
            videoHtml = '<p class="text-muted">No video available</p>';
        }

        $('#video-preview-container').html(videoHtml);
        $('#videoPreviewModal').modal('show');
    });

    $(document).on('click', '.show_confirm_delete', function(event) {
        event.preventDefault();
        var form = $(this).closest("form");
        var name = $(this).data("name");
        var activityTitle = $(this).data('activity-title') || 'this activity';        
        Swal.fire({
            title: `Delete ${name}?`,
            html: `Are you sure you want to delete <strong>${activityTitle}</strong>?<br>This action cannot be undone.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    $(document).on('click', 'button[data-add-more-images="true"]', function () {
        var title = $(this).data('title');
        var size = ($(this).data('size') == '') ? 'md' : $(this).data('size');
        var url = $(this).data('route');
        var data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            size: size,
            url: url
        };
        $("#commanModel .modal-title").html(title);
        $("#commanModel .modal-dialog").addClass('modal-' + size);
        
        $.ajax({
            url: url,
            type: 'get',
            data: data,
            success: function (data) {
                $('#commanModel .render-data').html(data.form);
                $("#commanModel").modal('show');
            },
            error: function (data) {
                data = data.responseJSON;
            }
        });
    });
    /*ACTIVITIES ADD MORE IMAGE MODAL SUBMIT */
    $(document).off('submit', '#addMoreImagesForm').on('submit', '#addMoreImagesForm', function (e) {
        e.preventDefault();        
        const formData = new FormData(this);
        const submitBtn = $(this).find('button[type="submit"]');        
        submitBtn.prop('disabled', true).html(`
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Uploading...
        `);        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                submitBtn.prop('disabled', false).html('Upload Images');                
                if (response.success) {
                    if (response.images && response.images.length > 0) {
                        response.images.forEach(function(image) {
                            const imageHtml = `
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-3 image-item" id="image-${image.id}">
                                    <div class="card h-100">
                                        <img src="${image.url}" class="card-img-top" alt="Activity Image" style="height: 120px; object-fit: cover;">
                                        <div class="card-body p-2 text-center">
                                            <button class="btn btn-sm btn-danger delete-activity-image" 
                                                    data-image-id="${image.id}"
                                                    data-route="/activities-image/${image.id}">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $('#activity-images-container').append(imageHtml);
                        });
                    }
                    
                    $('#addMoreImagesForm')[0].reset();
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-success",
                        close: true
                    }).showToast();
                } else {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger",
                        close: true
                    }).showToast();
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('Upload Images');
                
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'Validation error: ';
                    for (const field in errors) {
                        errorMessage += errors[field][0] + ' ';
                    }
                    Toastify({
                        text: errorMessage,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger",
                        close: true
                    }).showToast();
                } else {
                    Toastify({
                        text: xhr.responseJSON?.message || 'Error uploading images',
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger",
                        close: true
                    }).showToast();
                }
            }
        });
    });
    /*ACTIVITIES ADD MORE IMAGE MODAL SUBMIT */
    /*DELETE ACTIVITIES IMAGE */
    // Image deletion with confirmation
    $(document).on('click', '.delete-activity-image', function(e) {
        e.preventDefault();        
        var button = $(this);
        var imageId = button.data('image-id');
        var deleteRoute = button.data('route');     
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                button.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                );
                $.ajax({
                    url: deleteRoute,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#image-' + imageId).fadeOut(300, function() {
                                $(this).remove();
                                if ($('#activity-images-container .image-item').length === 0) {
                                    $('#activity-images-container').html(`
                                        <div class="col-12 text-center py-4">
                                            <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                            <p class="text-muted">No images found for this activity.</p>
                                        </div>
                                    `);
                                }
                            });                            
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                className: "bg-success",
                                close: true
                            }).showToast();
                        } else {
                            button.prop('disabled', false).html('<i class="fas fa-trash-alt"></i> Delete');
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                className: "bg-danger",
                                close: true
                            }).showToast();
                        }
                    },
                    error: function(xhr) {
                        button.prop('disabled', false).html('<i class="fas fa-trash-alt"></i> Delete');
                        
                        var errorMessage = 'Error deleting image';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        
                        Toastify({
                            text: errorMessage,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-danger",
                            close: true
                        }).showToast();
                    }
                });
            }
        });
    });

    /*DELETE ACTIVITIES IMAGE */
    /*Activities video modal */
    $(document).on('click', 'button[ data-add-more-video="true"]', function () {
        var title = $(this).data('title');
        var size = ($(this).data('size') == '') ? 'md' : $(this).data('size');
        var url = $(this).data('route');
        var data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            size: size,
            url: url
        };
        $("#commanModel .modal-title").html(title);
        $("#commanModel .modal-dialog").addClass('modal-' + size);
        
        $.ajax({
            url: url,
            type: 'get',
            data: data,
            success: function (data) {
                $('#commanModel .render-data').html(data.form);
                $("#commanModel").modal('show');
            },
            error: function (data) {
                data = data.responseJSON;
            }
        });
    });
    /*Activities video modal*/    
    /*activities videos destroy js */
    $(document).on('click', '.show_confirm_delete_activity_video', function (event) {
        event.preventDefault();
        let form = $(this).closest("form");
        let name = $(this).data("name") || "item";
        let activityTitle = $(this).data("activity-title") || "this item";

        Swal.fire({
            title: `Delete ${name}?`,
            html: `Are you sure you want to delete <strong>${activityTitle}</strong>?<br>This action cannot be undone.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    /*activities videos destroy js */
    
});
