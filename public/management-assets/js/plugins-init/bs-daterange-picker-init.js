(function($) {
    "use strict"

    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        autoUpdateInput: false, // Không tự động điền ngày
        locale: {
            format: 'YYYY-MM-DD',
            cancelLabel: 'Clear' // Nút hủy
        },
        buttonClasses: ['btn', 'btn-sm'],
        applyButtonClasses: 'btn-danger',
        cancelButtonClasses: 'btn-inverse'
    }).on('apply.daterangepicker', function(ev, picker) {
        // Khi người dùng chọn ngày
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
    }).on('cancel.daterangepicker', function(ev, picker) {
        // Khi người dùng nhấn hủy
        $(this).val('');
    });

    $('.input-daterange-timepicker').daterangepicker({
        autoUpdateInput: false, // Không tự động điền ngày giờ
        timePicker: true,
        locale: {
            format: 'MM/DD/YYYY h:mm A',
            cancelLabel: 'Clear'
        },
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    }).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY h:mm A') + ' - ' + picker.endDate.format('MM/DD/YYYY h:mm A'));
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('.input-limit-datepicker').daterangepicker({
        autoUpdateInput: false, // Không tự động điền ngày
        locale: {
            format: 'MM/DD/YYYY',
            cancelLabel: 'Clear'
        },
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    }).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
})(jQuery);
