jQuery(document).ready(function ($) {
    $('#my-email-form').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: my_email_form_ajax.ajaxurl,
            data: formData + '&action=my_email_form_submit',
            success: function (response) {
                console.log(response);
                $('#form-response').html('Thank you for subscribing!');
            }
        });
    });
});