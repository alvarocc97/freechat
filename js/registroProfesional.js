$(function() {
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

    $("#dialogoClavesIncorrectas,#dialogoCaptchaIncorrecto,#dialogoFormatoDNIIncorrecto,#dialogoDNIIncorrecto,#dialogoEmailIncorrecto,#dialogoProfesionalExistente,#dialogoProfesionalRegistrado").modal();
    $("#disparador1,#disparador2,#disparador3,#disparador4,#disparador5,#disparador6,#disparador7").hide().click();
});