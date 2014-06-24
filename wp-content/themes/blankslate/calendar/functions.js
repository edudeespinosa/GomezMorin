jQuery(document).ready(function($) {
    $(".tfdate").datepicker({
        dateFormat: 'D, M d, yy',
        showOn: 'button',
        buttonImage: window.location.origin + '/gomezMorin/images/icon-datepicker.png',
        buttonImageOnly: true,
        numberOfMonths: 3

    });
});