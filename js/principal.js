$(function() {
    $(".modal").modal();

    function bajarScroll() {
        var altoMain=document.getElementsByTagName("main")[0].scrollHeight;
        $("html, body").animate({
            scrollTop:altoMain
        }, 1000);
    }
    bajarScroll();

    $("a[href='#']").click(function(e) {
        e.preventDefault();
    });

    $('.tap-target').tapTarget('open');
    $(".button-collapse").sideNav();

    $("#salir").click(function() {
        if($("#dniUsuario").length>0) {
            let dniUsuario=$("#dniUsuario").text();
            $.post("php/cerrarSesion.php",{
                "dniUsuario":dniUsuario
            },function(respuesta) {
                if(respuesta=="1") {
                    window.location.href="index.php";
                }
            });
        } else {
            let nombreUsuario=$("title").text();
            $.post("php/cerrarSesion.php",{
                "nombreUsuario":nombreUsuario
            },function(respuesta) {
                if(respuesta=="1") {
                    window.location.href="index.php";
                }
            });
        }
        
    });

    $("#botonConfiguracion").click(function() {
        window.location.href="configuracion.php";
    });

    function actualizarConectados() {
        if($("#dniUsuario").length>0) {
            let dniUsuario=$("#dniUsuario").text();
            $.post("php/actualizarConectados.php",{
                "dniUsuario":dniUsuario
            },function(respuesta) {
                if(respuesta=="0") {
                    $("#slide-out>li:not(:first-child)").remove();
                    $("#slide-out").append("<li><div class='center-align' id='tituloProfesionalesConectados'>Profesionales conectados</div></li><li><div class='center-align'>No hay ningún profesional conectado</div></li><li><div class='center-align' id='tituloUsuariosConectados'>Usuarios conectados</div></li><li><div class='center-align'>No hay ningún usuario conectado</div></li>");
                } else {
                    $("#slide-out>li:not(:first-child)").remove();
                    let conectados=JSON.parse(respuesta);
                    if(conectados["profesionalesConectados"]) {
                        $("#slide-out").append("<li><div class='center-align' id='tituloProfesionalesConectados'>Profesionales conectados</div></li>");
                        $.each(conectados["profesionalesConectados"],function(clave,valor) {
                            $("#slide-out").append("<li><div class='center-align'>"+valor["nombre"]+" "+valor["apellidos"]+"<img class='profesionalStick' src='img/profesionalStick.png'></div></li>");
                        });
                        $("#slide-out").append("<li><div class='center-align' id='tituloUsuariosConectados'>Usuarios conectados</div></li><li><div class='center-align'>No hay ningún usuario conectado</div></li>");
                    } else if(conectados["usuariosConectados"]) {
                        $("#slide-out").append("<li><div class='center-align' id='tituloProfesionalesConectados'>Profesionales conectados</div></li><li><div class='center-align'>No hay ningún profesional conectado</div></li><li><div class='center-align' id='tituloUsuariosConectados'>Usuarios conectados</div></li>");
                        $.each(conectados["usuariosConectados"],function(clave,valor) {
                            $("#slide-out").append("<li><div class='center-align'>"+valor["nombre"]+"</div></li>");
                        });
                    } else if(conectados["profesionalesConectadosTotal"]) {
                        $("#slide-out").append("<li><div class='center-align' id='tituloProfesionalesConectados'>Profesionales conectados</div></li>");
                        $.each(conectados["profesionalesConectadosTotal"],function(clave,valor) {
                            $("#slide-out").append("<li><div class='center-align'>"+valor["nombre"]+" "+valor["apellidos"]+"<img class='profesionalStick' src='img/profesionalStick.png'></div></li>");
                        });
                        $("#slide-out").append("<li><div class='center-align' id='tituloUsuariosConectados'>Usuarios conectados</div></li>");
                        $.each(conectados["usuariosConectadosTotal"],function(clave,valor) {
                            $("#slide-out").append("<li><div class='center-align'>"+valor["nombre"]+"</div></li>");
                        });
                    }
                }
            });
        } else {
            let nombreUsuario=$("title").text();
            $.post("php/actualizarConectados.php",{
                "nombreUsuario":nombreUsuario
            },function(respuesta) {
                if(respuesta=="0") {
                    $("#slide-out>li:not(:first-child)").remove();
                    $("#slide-out").append("<li><div class='center-align' id='tituloProfesionalesConectados'>Profesionales conectados</div></li><li><div class='center-align'>No hay ningún profesional conectado</div></li><li><div class='center-align' id='tituloUsuariosConectados'>Usuarios conectados</div></li><li><div class='center-align'>No hay ningún usuario conectado</div></li>");
                } else {
                    $("#slide-out>li:not(:first-child)").remove();
                    let conectados=JSON.parse(respuesta);
                    if(conectados["profesionalesConectados"]) {
                        $("#slide-out").append("<li><div class='center-align' id='tituloProfesionalesConectados'>Profesionales conectados</div></li>");
                        $.each(conectados["profesionalesConectados"],function(clave,valor) {
                            $("#slide-out").append("<li><div class='center-align profesional' idProf='"+valor["dni"]+"'>"+valor["nombre"]+" "+valor["apellidos"]+"<img class='profesionalStick' src='img/profesionalStick.png'></div></li>");
                        });
                        $("#slide-out").append("<li><div class='center-align' id='tituloUsuariosConectados'>Usuarios conectados</div></li><li><div class='center-align'>No hay ningún usuario conectado</div></li>");
                    } else if(conectados["usuariosConectados"]) {
                        $("#slide-out").append("<li><div class='center-align' id='tituloProfesionalesConectados'>Profesionales conectados</div></li><li><div class='center-align'>No hay ningún profesional conectado</div></li><li><div class='center-align' id='tituloUsuariosConectados'>Usuarios conectados</div></li>");
                        $.each(conectados["usuariosConectados"],function(clave,valor) {
                            $("#slide-out").append("<li><div class='center-align'>"+valor["nombre"]+"</div></li>");
                        });
                    } else if(conectados["profesionalesConectadosTotal"]) {
                        $("#slide-out").append("<li><div class='center-align' id='tituloProfesionalesConectados'>Profesionales conectados</div></li>");
                        $.each(conectados["profesionalesConectadosTotal"],function(clave,valor) {
                            $("#slide-out").append("<li><div class='center-align profesional' idProf='"+valor["dni"]+"'>"+valor["nombre"]+" "+valor["apellidos"]+"<img class='profesionalStick' src='img/profesionalStick.png'></div></li>");
                        });
                        $("#slide-out").append("<li><div class='center-align' id='tituloUsuariosConectados'>Usuarios conectados</div></li>");
                        $.each(conectados["usuariosConectadosTotal"],function(clave,valor) {
                            $("#slide-out").append("<li><div class='center-align'>"+valor["nombre"]+"</div></li>");
                        });
                    }
                }
                enviarPeticion();
            });
        }
        
    }

    setTimeout(function() {
        setInterval(actualizarConectados,2000);
    },2000);

    function actualizarChat() {
        if($("#dniUsuario").length>0) {
            let dniUsuario=$("#dniUsuario").text();
            $.post("php/comprobarSilenciado.php",{
                "dniUsuario":dniUsuario
            },function(respuesta) {
                if(respuesta=="0") {
                    $.post("php/actualizarChat.php",function(respuesta) {
                        if(respuesta=="0") {
                            $("main>div>div").remove();
                            $("main>div").append($("<div class='row'><div class='col s12 center-align'><p id='noMensajes'>No hay mensajes</p></div></div>"));
                        } else {
                            $("main>div>div").remove();
                            let mensajes=JSON.parse(respuesta);
                            $.each(mensajes,function(clave,valor) {
                                if(valor["dni"]==dniUsuario && valor["profesional"]=="S") {
                                    $("main>div").append($("<div class='row'><div class='contenedorEnviado'><div class='datosEnviado'><span>"+valor["usuario"]+"<img class='profesionalStick' src='img/profesionalStick.png'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span>"+valor["fecha"]+"</span></div><div class='mensajeEnviado'>"+valor["mensaje"]+"</div></div></div>"));
                                } else {
                                    if(valor["profesional"]=="S") {
                                        $("main>div").append($("<div class='row'><div class='contenedorRecibido'><div class='datosRecibido'><span>"+valor["usuario"]+"<img class='profesionalStick' src='img/profesionalStick.png'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span>"+valor["fecha"]+"</span></div><div class='mensajeRecibido'>"+valor["mensaje"]+"</div></div></div>"));
                                    } else {
                                        $("main>div").append($("<div class='row'><div class='contenedorRecibido'><div class='datosRecibido'><span>"+valor["usuario"]+"</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>"+valor["fecha"]+"</span></div><div class='mensajeRecibido'>"+valor["mensaje"]+"</div></div></div>"));
                                    }
                                }
                            });
                        }
                    });
                } else {
                    $("main>div>div").remove();
                    $("main>div").append($("<div class='row'><div class='col s12 center-align'><p id='chatSilenciado'><i class='material-icons'>speaker_notes_off</i>chat silenciado</p></div></div>"));  
                }
            })
        } else {
            let nombreUsuario=$("title").text();
            $.post("php/comprobarSilenciado.php",{
                "nombreUsuario":nombreUsuario
            },function(respuesta) {
                if(respuesta=="0") {
                    $.post("php/actualizarChat.php",function(respuesta) {
                        if(respuesta=="0") {
                            $("main>div>div").remove();
                            $("main>div").append($("<div class='row'><div class='col s12 center-align'><p id='noMensajes'>No hay mensajes</p></div></div>"));
                        } else {
                            $("main>div>div").remove();
                            let mensajes=JSON.parse(respuesta);
                            $.each(mensajes,function(clave,valor) {
                                if(valor["usuario"]==nombreUsuario && valor["profesional"]=="N") {
                                    $("main>div").append($("<div class='row'><div class='contenedorEnviado'><div class='datosEnviado'><span>"+valor["usuario"]+"</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>"+valor["fecha"]+"</span></div><div class='mensajeEnviado'>"+valor["mensaje"]+"</div></div></div>"));
                                } else {
                                    if(valor["profesional"]=="S") {
                                        $("main>div").append($("<div class='row'><div class='contenedorRecibido'><div class='datosRecibido'><span>"+valor["usuario"]+"<img class='profesionalStick' src='img/profesionalStick.png'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span>"+valor["fecha"]+"</span></div><div class='mensajeRecibido'>"+valor["mensaje"]+"</div></div></div>"));
                                    } else {
                                        $("main>div").append($("<div class='row'><div class='contenedorRecibido'><div class='datosRecibido'><span>"+valor["usuario"]+"</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>"+valor["fecha"]+"</span></div><div class='mensajeRecibido'>"+valor["mensaje"]+"</div></div></div>"));
                                    }
                                }
                            });
                        }
                    });
                } else {
                    $("main>div>div").remove();
                    $("main>div").append($("<div class='row'><div class='col s12 center-align'><p id='chatSilenciado'><i class='material-icons'>speaker_notes_off</i>chat silenciado</p></div></div>"));
                }
            })
        }
    }

    setTimeout(function() {
        setInterval(actualizarChat,1000);
    },1000);

    $("#botonEnviar").click(function() {
        if($("#dniUsuario").length>0) {
            let dniUsuario=$("#dniUsuario").text();
            let mensajeUsuario=$("#mensajeUsuario").val();

            $.post("php/enviarMensaje.php",{
                "dni":dniUsuario,
                "mensaje":mensajeUsuario
            },function(respuesta) {
                if(respuesta=="1") {
                    $("#mensajeUsuario").val("");
                    actualizarChat();
                    bajarScroll();
                }
            });
        } else {
            let mensajeUsuario=$("#mensajeUsuario").val();
            let nombreUsuario=$("title").text();

            $.post("php/enviarMensaje.php",{
                "usuario":nombreUsuario,
                "mensaje":mensajeUsuario
            },function(respuesta) {
                if(respuesta=="1") {
                    $("#mensajeUsuario").val("");
                    actualizarChat();
                    bajarScroll();
                }
            });
        }
    });

    $("#mensajeUsuario").keyup(function(e) {
        if($(this).val().length==0) {
            $("#botonEnviar").attr("disabled",true);
        } else {
            $("#botonEnviar").removeAttr("disabled");
            if(e.key=="Enter") {
                $("#botonEnviar").click();
            }
        }
    });

    function enviarPeticion() {
        $(".profesional").click(function() {
            let solicitado=$(this).attr("idProf");
            let solicitante=$("title").text();

            $.post("php/enviarPeticion.php",{
                "solicitado":solicitado,
                "solicitante":solicitante
            },function(respuesta) {
                if(respuesta=="0") {
                    Materialize.toast("Ya tienes una conversación privada abierta",3000,"",function() {
                        Materialize.toast("Cierra la conversación actual para poder solicitar otra",3000);
                    });
                } else if(respuesta=="1") {
                    Materialize.toast("Petición enviada",2000,"",function() {
                        Materialize.toast("Espera a que el profesional acepte",2000);
                    });
                } else if(respuesta=="2") {
                    Materialize.toast("Ya le has enviado una petición a este profesional, espera a que acepte",3000);
                } else if(respuesta=="3") {
                    Materialize.toast("Ya has enviado una petición a un profesional, espera a que acepte",3000);
                }
            });
        });
    }
    enviarPeticion();

    function actualizarNotificaciones() {
        if($("#dniUsuario").length>0) {
            let dniProfesional=$("#dniUsuario").text();
            let elementoClonado=$("#nombreUsuario").clone();
            let elementoABorrar=elementoClonado.find(".new.badge,i");
            elementoABorrar.remove();
            let nombreUsuario=elementoClonado.text();
            let peticionesAnteriores=$(".badge-collapse").text();

            $.post("php/actualizarNotificaciones.php",{
                "dniProfesional":dniProfesional
            },function(respuesta) {
                let respuestaNotificaciones=JSON.parse(respuesta);
                if(respuestaNotificaciones[0]>0) {
                    if(respuestaNotificaciones[0]==1) {
                        if(respuestaNotificaciones[1]=="N") {
                            $("#peticiones-trigger").remove();
                            $("#nombreUsuario span.name").append("<a id='peticiones-trigger' href='#modalPeticiones' class='modal-trigger'><span class='new badge' data-badge-caption='petición'>"+respuestaNotificaciones[0]+"</span></a>");
                        } else {
                            console.log($("#nombreUsuario i"));
                            $("#peticiones-trigger,#nombreUsuario i").remove();
                            $("#nombreUsuario span.name").append("<i class='material-icons' title='Permaneces oculto para el resto de usuarios'>visibility_off</i><a id='peticiones-trigger' href='#modalPeticiones' class='modal-trigger'><span class='new badge' data-badge-caption='petición'>"+respuestaNotificaciones[0]+"</span></a>");
                        }
                    } else {
                        if(respuestaNotificaciones[1]=="N") {
                            $("#peticiones-trigger").remove();
                            $("#nombreUsuario span.name").append("<a id='peticiones-trigger' href='#modalPeticiones' class='modal-trigger'><span class='new badge' data-badge-caption='peticiones'>"+respuestaNotificaciones[0]+"</span></a>");
                        } else {
                            $("#peticiones-trigger,#nombreUsuario i").remove();
                            $("#nombreUsuario span.name").append("<i class='material-icons' title='Permaneces oculto para el resto de usuarios'>visibility_off</i><a id='peticiones-trigger' href='#modalPeticiones' class='modal-trigger'><span class='new badge' data-badge-caption='peticiones'>"+respuestaNotificaciones[0]+"</span></a>");
                        }
                        
                    }
                    $("title").text("");
                    $("title").text(nombreUsuario+" ("+respuestaNotificaciones[0]+")");
                    $(".badge-collapse").remove();
                    $("a.button-collapse").append("<span class='badge-collapse'>"+respuestaNotificaciones[0]+"</span>");
                } else {
                    $("title").text(nombreUsuario);
                    $("#peticiones-trigger").remove();
                    $(".badge-collapse").remove();
                }
            });
        }
    }
    setTimeout(function() {
        setInterval(actualizarNotificaciones,2000);
    },2000);

    function actualizarPeticiones() {
        if($("#dniUsuario").length>0) {
            let dniProfesional=$("#dniUsuario").text();

            $.post("php/actualizarPeticiones.php", {
                "solicitado":dniProfesional
            },function(respuesta) {
                let peticiones=JSON.parse(respuesta);
                if(peticiones.length==0) {
                    $("#modalPeticiones").modal("close");
                } else {
                    $("#modalPeticiones ul.collection li").remove();
                    $.each(peticiones, function(indice,valor) {
                        if(valor['privadaActiva']=="N") {
                            $("#modalPeticiones ul.collection").append("<li class='collection-item avatar'><img src='"+valor['imagen']+"' class='circle' alt='IMAGEN NO DISPONIBLE'><span class='title'>"+valor['solicitante']+"</span><p><span class='italic'>Fecha: </span>"+valor['fecha']+"</p><span class='secondary-content'><button class='btn-floating waves-effect waves-light green aceptarPeticion' title='Aceptar petición'><i class='material-icons'>check</i></button><button style='margin-left:.26em' class='btn-floating waves-effect waves-light red rechazarPeticion' title='Rechazar petición'><i class='material-icons'>clear</i></button></span></li>");
                        } else {
                            $("#modalPeticiones ul.collection").append("<li class='collection-item avatar'><img src='"+valor['imagen']+"' class='circle' alt='IMAGEN NO DISPONIBLE'><span class='title'>"+valor['solicitante']+"</span><p><span class='italic'>Fecha: </span>"+valor['fecha']+"</p><span class='secondary-content'><button class='btn-floating waves-effect waves-light green aceptarPeticion' title='Ya tienes una conversación privada abierta' disabled><i class='material-icons'>check</i></button><button style='margin-left:.26em' class='btn-floating waves-effect waves-light red rechazarPeticion' title='Rechazar petición'><i class='material-icons'>clear</i></button></span></li>");
                        }  
                    });
                    rechazarPeticion();
                    aceptarPeticion();
                }
            });
        }
    }

    setTimeout(function() {
        setInterval(actualizarPeticiones,2000);
    },2000);

    function rechazarPeticion() {
        $(".rechazarPeticion").click(function() {
            let solicitado=$("#dniUsuario").text();
            let solicitante=$(this).parent().parent().children(".title").text();

            $.post("php/rechazarPeticion.php", {
                "solicitado":solicitado,
                "solicitante":solicitante
            },function(respuesta) {
                if(respuesta=="1") {
                    Materialize.toast("Petición rechazada",2000);
                    actualizarPeticiones();
                    actualizarNotificaciones();
                }
            });
        })
    }
    rechazarPeticion();

    function aceptarPeticion() {
        $(".aceptarPeticion").click(function() {
            let solicitado=$("#dniUsuario").text();
            let solicitante=$(this).parent().parent().children(".title").text();

            $.post("php/aceptarPeticion.php", {
                "solicitado":solicitado,
                "solicitante":solicitante
            },function(respuesta) {
                if(respuesta=="0") {
                    Materialize.toast("La usuaria no está conectada en este momento",3000);
                } else {
                    actualizarPeticiones();
                    actualizarNotificaciones();
                    window.location.href="privado.php";
                }
            });
        });
    }
    aceptarPeticion();

    function comprobarChatPrivado() {
        if($("#dniUsuario").length==0) {
            let solicitante=$("title").text();

            $.post("php/comprobarChatPrivado.php",{
                "solicitante":solicitante
            },function(respuesta) {
                if(respuesta=="1") {
                    window.location.href="privado.php";
                }
            });
        }
    }
    setInterval(comprobarChatPrivado,2000);

});