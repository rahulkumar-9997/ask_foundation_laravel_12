
$(document).ready(function() {
    $(document).on("click", ".add-more-activities-section", function() {
        let newRow = `
            <tr class="activities-video-row">
                <td style="width: 25%">
                    <input type="text" name="act_video_title[]" class="form-control" placeholder="Enter activities video title">
                </td>
                <td style="width: 25%; text-align: center;">
                    <input type="file" name="activities_video_file[]" class="form-control mb-1">
                    <span class="text-center text-success d-block mb-1">OR</span>
                    <input type="text" name="activities_video_link[]" class="form-control" placeholder="Enter activities video link">
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




    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: `Are you sure you want to delete this ${name}?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            dangerMode: true,
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

});
