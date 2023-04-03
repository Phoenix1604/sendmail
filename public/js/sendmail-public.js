jQuery(document).ready(function ($) {
    $('#my-email-form').submit(function (event) {
        event.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: my_email_form_ajax.ajaxurl,
            data: formData + '&action=my_email_form_submit',
            success: function (response) {
                let json = JSON.parse(response);
                console.log(json);
                $('#form-response').html(json.message);
            }
        });
    });
});