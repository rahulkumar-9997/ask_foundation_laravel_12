$(document).ready(function () {
    $(document).off('submit', '#donateForm').on('submit', '#donateForm', function (event) {
        event.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');

        $('.Field-el').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        submitButton.prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...'
        );
        var formData = new FormData(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                submitButton.prop('disabled', false).html(
                    'Donate <span id="donate-amount-text">₹ ' + $('input[name="amount"]').val() + '</span>'
                );
                if (response.status === 'success') {
                    form[0].reset();
                    $('#donate-amount-text').text('₹ 0.00');
                    window.location.href = response.redirect;
                }
            },
            error: function (xhr) {
                submitButton.prop('disabled', false).html(
                    'Donate <span id="donate-amount-text">₹ ' + $('input[name="amount"]').val() + '</span>'
                );
                var errors = xhr.responseJSON?.errors;
                if (errors) {
                    $.each(errors, function (key, value) {
                        var inputField = $('#' + key);
                        inputField.addClass('is-invalid');
                        inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                    });
                } else {
                    ashowNotificationAll('Something went wrong. Please try again later.', 'error');
                }
            }
        });
    });
});
