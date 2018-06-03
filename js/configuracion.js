$(function() {
    $("#claveProf,#claveUsuario").keyup(function(e) {
        if($(this).val().length==0) {
            $("#clave2Prof,#clave2Usuario").attr("disabled",true);
            $("#clave2Prof,#clave2Usuario").removeAttr("required");
        } else {
            $("#clave2Prof,#clave2Usuario").removeAttr("disabled");
            $("#clave2Prof,#clave2Usuario").attr("required",true);
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

    $("#dialogoEliminarCuenta").modal();

    $(".modal-eliminar").click(function() {
        if($("#dniProf").length>0) {
            let dniProfesional=$("#profesionalOculto").text();

            $.post("php/eliminarCuenta.php",{
                "dniProfesional":dniProfesional
            },function(respuesta) {
                if(respuesta=="1") {
                    window.location.href="index.php";
                }
            });
        } else {
            let nombreUsuario=$("#usuarioOculto").text();

            $.post("php/eliminarCuenta.php",{
                "nombreUsuario":nombreUsuario
            },function(respuesta) {
                if(respuesta=="1") {
                    window.location.href="index.php";
                }
            });
        }
    });

    function comprobarSwitches() {
        if($("#dniProf").length>0) {
            let dniProfesional=$("#profesionalOculto").text();

            $.post("php/comprobarSwitches.php",{
                "dniProfesional":dniProfesional
            },function(respuesta) {
                switch(respuesta) {
                    case "0":
                        $("#silenciarSwitch").removeProp("checked");
                        $("#ocultarSwitch").removeProp("checked");
                    break;
                    case "1":
                        $("#silenciarSwitch").removeProp("checked");
                        $("#ocultarSwitch").prop("checked",true); 
                    break;
                    case "2":
                        $("#silenciarSwitch").prop("checked",true);
                        $("#ocultarSwitch").removeProp("checked"); 
                    break;
                    case "3":
                        $("#silenciarSwitch").prop("checked",true);
                        $("#ocultarSwitch").prop("checked",true); 
                    break;
                }
            });
        } else {
            let nombreUsuario=$("#usuarioOculto").text();

            $.post("php/comprobarSwitches.php",{
                "nombreUsuario":nombreUsuario
            },function(respuesta) {
                switch(respuesta) {
                    case "0":
                        $("#silenciarSwitch").removeProp("checked");
                        $("#ocultarSwitch").removeProp("checked");
                    break;
                    case "1":
                        $("#silenciarSwitch").removeProp("checked");
                        $("#ocultarSwitch").prop("checked",true); 
                    break;
                    case "2":
                        $("#silenciarSwitch").prop("checked",true);
                        $("#ocultarSwitch").removeProp("checked"); 
                    break;
                    case "3":
                        $("#silenciarSwitch").prop("checked",true);
                        $("#ocultarSwitch").prop("checked",true); 
                    break;
                }
            });
        }
    }
    comprobarSwitches();

    $("#silenciarSwitch").change(function() {
        if($("#silenciarSwitch").prop("checked")) {
            if($("#dniProf").length>0) {
                let dniProfesional=$("#profesionalOculto").text();

                $.post("php/activarSilenciado.php",{
                    "dniProfesional":dniProfesional
                },function(respuesta) {
                    if(respuesta=="1") {
                       Materialize.toast("Chat silenciado",2000);
                    } 
                });
            } else {
                let nombreUsuario=$("#usuarioOculto").text();

                $.post("php/activarSilenciado.php",{
                    "nombreUsuario":nombreUsuario
                },function(respuesta) {
                    if(respuesta=="1") {
                        Materialize.toast("Chat silenciado",2000);
                    } 
                });
            }
        } else {
            if($("#dniProf").length>0) {
                let dniProfesional=$("#profesionalOculto").text();

                $.post("php/desactivarSilenciado.php",{
                    "dniProfesional":dniProfesional
                },function(respuesta) {
                    if(respuesta=="1") {
                        Materialize.toast("Vuelves a recibir mensajes",2000);
                    } 
                });
            } else {
                let nombreUsuario=$("#usuarioOculto").text();

                $.post("php/desactivarSilenciado.php",{
                    "nombreUsuario":nombreUsuario
                },function(respuesta) {
                    if(respuesta=="1") {
                        Materialize.toast("Vuelves a recibir mensajes",2000);
                    } 
                });
            }
        }
    });

    $("#ocultarSwitch").change(function() {
        if($("#ocultarSwitch").prop("checked")) {
            if($("#dniProf").length>0) {
                let dniProfesional=$("#profesionalOculto").text();

                $.post("php/activarOculto.php",{
                    "dniProfesional":dniProfesional
                },function(respuesta) {
                    if(respuesta=="1") {
                       Materialize.toast("Ahora estás oculto para el resto de usuarios",2000);
                    } 
                });
            } else {
                let nombreUsuario=$("#usuarioOculto").text();

                $.post("php/activarOculto.php",{
                    "nombreUsuario":nombreUsuario
                },function(respuesta) {
                    if(respuesta=="1") {
                        Materialize.toast("Ahora estás oculto para el resto de usuarios",2000);
                    } 
                });
            }
        } else {
            if($("#dniProf").length>0) {
                let dniProfesional=$("#profesionalOculto").text();

                $.post("php/desactivarOculto.php",{
                    "dniProfesional":dniProfesional
                },function(respuesta) {
                    if(respuesta=="1") {
                        Materialize.toast("Vuelves a ser visible para el resto de usuarios",2000);
                    } 
                });
            } else {
                let nombreUsuario=$("#usuarioOculto").text();

                $.post("php/desactivarOculto.php",{
                    "nombreUsuario":nombreUsuario
                },function(respuesta) {
                    if(respuesta=="1") {
                        Materialize.toast("Vuelves a ser visible para el resto de usuarios",2000);
                    } 
                });
            }
        }
    });
});