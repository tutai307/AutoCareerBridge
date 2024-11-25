(function ($) {
    "use strict"

    // MAterial Date picker
    $('#mdate').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false
    });
    $('#timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        time: true,
        date: false
    });


    var locale = moment.locale('vi');
    $('.date-format').bootstrapMaterialDatePicker({
        locale: locale, 
        format: 'YYYY-MM-DD HH:mm:ss',
        minDate: new Date() 
    });

    $('#min-date').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm',
        minDate: new Date()
    });

})(jQuery);