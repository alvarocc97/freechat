$(function() {
    $("#claveProf").keyup(function(e) {
        if($(this).val().length==0) {
            $("#clave2Prof").attr("disabled",true);
            $("#clave2Prof").removeAttr("required");
        } else {
            $("#clave2Prof").removeAttr("disabled");
            $("#clave2Prof").attr("required",true);
        }
    });

    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 100,
        min: [1900,1,1],
        max: new Date(),
        today: 'Hoy',
        clear: 'Limpiar',
        close: 'Aceptar',
        closeOnSelect: false,
        labelMonthNext: 'Mes siguiente',
        labelMonthPrev: 'Mes anterior',
        labelMonthSelect: 'Selecciona un mes',
        labelYearSelect: 'Selecciona un año',
        monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
        monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
        weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado' ],
        weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
        weekdaysLetter: [ 'D', 'L', 'M', 'X', 'J', 'V', 'S' ],
        firstDay: true,
        format: 'yyyy-mm-dd'
    });
});