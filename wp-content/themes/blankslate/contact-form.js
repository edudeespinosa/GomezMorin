jQuery(document).ready(function() {

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    jQuery("#frmContact").validate({
        invalidHandler: function(event, validator) {
            var list = validator.errorList;
            $.each(list, function(index, item) {
                $(item).addClass("errorLabel");
            });
        },
        rules: {
            frmName: {
                required: true,
                minlength: 3
            },
            frmEmail: {
                required: function(element) {
                    if (!$("#frmPhone").val() == "")
                        return false;
                    else
                        return true;
                },
                email: true
            },
            frmPhone: {
                required: true

            },
            frmMessage: {
                required: true
            }
        },
        messages: {
            frmName: {
                required: "Please include your name.",
                minlength: "Please ensure your name is longer than {0} characters.",
            }

        }
    });



});