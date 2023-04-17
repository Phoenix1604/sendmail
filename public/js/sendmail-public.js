jQuery(document).ready(function ($) {
    $('#sendmail-email-form').submit(function (event) {
        event.preventDefault();
        let email = $('#sendmail-email-form :input').val();
        //console.log(email);
        $.ajax({
            type: 'POST',
            url: sendmail_email_form_ajax.ajaxurl,
            data: {
                action: 'sendmail_email_form_submit',
                nonce_data: sendmail_email_form_ajax.nonce,
                email: email
            },
            success: function (response) {
                let json = JSON.parse(response);
                console.log(json);
                $('#form-response').html(json.message);
            },
            error: function (response) {
                console.log(response);
                alert("Failed to subscribe. Please try again after sometime");
            }
        });
    });
});