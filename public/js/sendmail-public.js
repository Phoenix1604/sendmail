jQuery(document).ready(function ($) {
    $('#sendmail-email-form').submit(function (event) {
        event.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: sendmail_email_form_ajax.ajaxurl,
            data: formData + '&action=sendmail_email_form_submit',
            success: function (response) {
                let json = JSON.parse(response);
                console.log(json);
                $('#form-response').html(json.message);
            }
        });
    });
});