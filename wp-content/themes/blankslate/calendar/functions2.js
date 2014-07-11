jQuery(document).ready(function($) {
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };

    $.datepicker.setDefaults($.datepicker.regional['es']);

    var today = new Date();

    function getMaxDay(i) {
        switch (i) {
            case 0:
            case 2:
            case 4:
            case 6:
            case 7:
            case 9:
            case 11:
                return 31;
                break;
            case 1:
                if (today.getFullYear() % 4 == 0)
                    return 29;
                else return 28;
                break;
            default:
                return 30;
        }
    }

    $(".calendario").datepicker({
        dateFormat: 'dd/mm/yy',
        buttonImage: window.location.origin + '/gomezMorin/images/icon-datepicker.png',
        minDate: new Date(today.getFullYear(), today.getMonth(), 1),
        maxDate: new Date(today.getFullYear(), today.getMonth(), getMaxDay(today.getMonth())),
        altField: "#calendar",
        altFormat: 'dd-mm-yy'
    });
});