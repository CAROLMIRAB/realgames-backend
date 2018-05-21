$(function () {

    var locale = Core.getCookie('localejs');
    var lang = (locale == null || locale == '') ? 'en_GB' : locale;
    if (lang === 'es_ES') {
        // Configure daterangepicker
        $('#date-range').daterangepicker({
                autoApply: true,
                opens: 'left',
                startDate: moment().subtract('days', 6),
                maxDate: moment(),
                showDropdowns: true,
                showWeekNumbers: true,
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Últimos 7 Días': [moment().subtract('days', 6), moment()],
                    'Últimos 30 Días': [moment().subtract('days', 29), moment()],
                    'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                    'Mes Pasado': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                buttonClasses: ['btn btn-sm'],
                applyClass: ' blue',
                cancelClass: 'default',
                format: 'DD/MM/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Aceptar',
                    cancelLabel: 'Cancelar',
                    fromLabel: 'Desde',
                    toLabel: 'Hasta',
                    customRangeLabel: 'Rango Personalizado',
                    daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    firstDay: 1
                }
            },
            function (start, end) {
                $('#date-range span').html(start.locale('es').format('MMMM D, YYYY') + ' - ' + end.locale('es').format('MMMM D, YYYY'));
            }
        );

        // Set the initial date
        $('#date-range span').html(moment().subtract('days', 6).locale('es').format('MMMM D, YYYY') + ' - ' + moment().locale('es').format('MMMM D, YYYY'));
        $('#start-date').val(moment().subtract('days', 6).format('YYYY-MM-DD'));
        $('#end-date').val(moment().format('YYYY-MM-DD'));

        // Set the selected date in hidden files
        $('#date-range').on('apply.daterangepicker', function (ev, picker) {
            $('#start-date').val(picker.startDate.format('YYYY-MM-DD'));
            $('#end-date').val(picker.endDate.format('YYYY-MM-DD'));
        });
    } else {
        $('#date-range').daterangepicker({
                autoApply: true,
                opens: 'left',
                startDate: moment().subtract('days', 6),
                maxDate: moment(),
                showDropdowns: true,
                showWeekNumbers: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This month': [moment().startOf('month'), moment().endOf('month')],
                    'Last month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                buttonClasses: ['btn btn-sm'],
                applyClass: ' blue',
                cancelClass: 'default',
                format: 'DD/MM/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'To accept',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'unto',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thurs', 'Fri', 'Sat'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            },
            function (start, end) {
                $('#date-range span').html(start.locale('en').format('MMMM D, YYYY') + ' - ' + end.locale('en').format('MMMM D, YYYY'));
            }
        );
        // Set the initial date
        $('#date-range span').html(moment().subtract('days', 6).locale('en').format('MMMM D, YYYY') + ' - ' + moment().locale('en').format('MMMM D, YYYY'));
        $('#start-date').val(moment().subtract('days', 6).format('YYYY-MM-DD'));
        $('#end-date').val(moment().format('YYYY-MM-DD'));

        // Set the selected date in hidden files
        $('#date-range').on('apply.daterangepicker', function (ev, picker) {
            $('#start-date').val(picker.startDate.format('YYYY-MM-DD'));
            $('#end-date').val(picker.endDate.format('YYYY-MM-DD'));
        });
    }


});