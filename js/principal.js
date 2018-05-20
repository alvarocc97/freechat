$(function() {
    function bajarScroll() {
        var altoMain=document.getElementsByTagName("main")[0].scrollHeight;
        $("html, body").animate({
            scrollTop:altoMain
        }, 1000);
    }
    bajarScroll();

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
                } else {
                    alert("ERROR");
                }
            });
        } else {
            let nombreUsuario=$("title").text();
            $.post("php/cerrarSesion.php",{
                "nombreUsuario":nombreUsuario
            },function(respuesta) {
                if(respuesta=="1") {
                    window.location.href="index.php";
                } else {
                    alert("ERROR");
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
            let nombreUsuario=$("title").text();
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
                } else {
                    // *** INSERTAR UN MENSAJE QUE NO SEA ALERT ***
                    alert(ERROR);
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
                } else {
                    // *** INSERTAR UN MENSAJE QUE NO SEA ALERT ***
                    alert(ERROR);
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
            if($("#dniUsuario").length>0) {
                var solicitante=$("#dniUsuario").text();
            } else {
                var solicitante=$("title").text();
            }

            $.post("php/enviarPeticion.php",{
                "solicitado":solicitado,
                "solicitante":solicitante
            },function(respuesta) {
                if(respuesta=="1") {
                    Materialize.toast("Petición enviada",2000,"",function() {
                        Materialize.toast("Espera a que el profesional acepte",2000);
                    });
                } else if(respuesta=="2") {
                    Materialize.toast("Ya le has enviado una petición a este profesional, espera a que acepte",3000);
                } else {
                    // *** INSERTAR UN MENSAJE QUE NO SEA ALERT ***
                    alert(ERROR);
                }
            });
        });
    }
    enviarPeticion();

    function actualizarNotificaciones() {
        if($("#dniUsuario").length>0) {
            let dniProfesional=$("#dniUsuario").text();
            let elementoClonado=$("#nombreUsuario").clone();
            let elementoABorrar=elementoClonado.find(".new.badge");
            elementoABorrar.remove();
            let nombreUsuario=elementoClonado.text();
            let peticionesAnteriores=$(".badge-collapse").text();

            $.post("php/actualizarNotificaciones.php",{
                "dniProfesional":dniProfesional
            },function(respuesta) {
                if(respuesta>0) {
                    if(respuesta==1) {
                        $("#nombreUsuario .new.badge").remove();
                        $("#nombreUsuario span.name").append("<span class='new badge' data-badge-caption='petición'>"+respuesta+"</span>");
                    } else {
                        $("#nombreUsuario .new.badge").remove();
                        $("#nombreUsuario span.name").append("<span class='new badge' data-badge-caption='peticiones'>"+respuesta+"</span>");
                    }
                    $("title").text("");
                    $("title").text(nombreUsuario+" ("+respuesta+")");
                    $(".badge-collapse").text("");
                    $(".badge-collapse").text(respuesta);
                } else {
                    $("title").text(nombreUsuario);
                    $("#nombreUsuario .new.badge").remove();
                    $(".badge-collapse").remove();
                }
            });
        }
    }
    setTimeout(function() {
        setInterval(actualizarNotificaciones,2000);
    },2000);
});