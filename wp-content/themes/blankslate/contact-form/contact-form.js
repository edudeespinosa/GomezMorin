jQuery(document).ready(function() {

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    jQuery("#111").validate({
        invalidHandler: function(event, validator) {
            var list = validator.errorList;
            jQuery.each(list, function(index, item) {
                jQuery(item).addClass("errorLabel");
            });
        },
        rules: {
            frmName: {
                required: true,
                minlength: 3
            },
            frmSubject: {
                required: true,
                minlength: 3
            },
            frmEmail: {
                required: true,
                email: true
            },
            frmMessage: {
                required: true
            }
        },
        messages: {}
    });



});