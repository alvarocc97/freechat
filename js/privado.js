$(function() {
    $(".modal").modal();

    function bajarScroll() {
        var altoMain=document.getElementsByTagName("main")[0].scrollHeight;
        $("html, body").animate({
            scrollTop:altoMain
        }, 1000);
    }
    bajarScroll();

    $('.tap-target').tapTarget('open');
    $(".button-collapse").sideNav();
    $("#cerrarPrivado").click(function() {
        if($("#profesionalOculto").length>0) {
            var dniProfesional=$("#profesionalOculto").text();
            var nombreUsuario=$("#nombreUsuario span").text();
        } else {
            var dniProfesional=$("#nombreUsuario span").attr("idProf");
            var nombreUsuario=$("#usuarioOculto").text();
        }
        let nombreTabla=$("#nombreTablaOculto").text();

        $.post("php/cerrarPrivado.php",{
            "dniProfesional":dniProfesional,
            "nombreUsuario":nombreUsuario,
            "nombreTabla":nombreTabla
        },function(respuesta) {
            if(respuesta=="1") {
                window.location.href="principal.php";
            }
        });
        
    });

    $("#botonConfiguracion").click(function() {
        window.location.href="configuracion.php";
    });

    $("#botonEnviar").click(function() {
        if($("#profesionalOculto").length>0) {
            let dniProfesional=$("#profesionalOculto").text();
            let mensajeProfesional=$("#mensajeUsuario").val();
            let nombreTabla=$("#nombreTablaOculto").text();

            $.post("php/enviarMensajePrivado.php",{
                "dniProfesional":dniProfesional,
                "mensajeProfesional":mensajeProfesional,
                "nombreTabla":nombreTabla
            },function(respuesta) {
                if(respuesta=="1") {
                    $("#mensajeUsuario").val("");
                    actualizarChatPrivado();
                }
            });
        } else {
            let nombreUsuario=$("#usuarioOculto").text();
            let mensajeUsuario=$("#mensajeUsuario").val();
            let nombreTabla=$("#nombreTablaOculto").text();

            $.post("php/enviarMensajePrivado.php",{
                "nombreUsuario":nombreUsuario,
                "mensajeUsuario":mensajeUsuario,
                "nombreTabla":nombreTabla
            },function(respuesta) {
                if(respuesta=="1") {
                    $("#mensajeUsuario").val("");
                    actualizarChatPrivado();
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

    function actualizarChatPrivado() {
        if($("#profesionalOculto").length>0) {
            let dniProfesional=$("#profesionalOculto").text();
            let nombreTabla=$("#nombreTablaOculto").text();

            $.post("php/actualizarChatPrivado.php",{
                "nombreTabla":nombreTabla
            },function(respuesta) {
                if(respuesta=="0") {
                    $("main>div>div").remove();
                    $("main>div").append($("<div class='row'><div class='col s12 center-align'><p id='noMensajes'>No hay mensajes</p></div></div>"));
                } else {
                    $("main>div>div").remove();
                    let mensajes=JSON.parse(respuesta);
                    $.each(mensajes,function(clave,valor) {
                        if(valor["profesional"]==dniProfesional) {
                            $("main>div").append($("<div class='row'><div class='contenedorEnviado'><div class='datosEnviado'><span>"+valor["nomApeProfesional"]+"<img class='profesionalStick' src='img/profesionalStick.png'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span>"+valor["fecha"]+"</span></div><div class='mensajeEnviado'>"+valor["mensaje"]+"</div></div></div>"));
                        } else {
                            $("main>div").append($("<div class='row'><div class='contenedorRecibido'><div class='datosRecibido'><span>"+valor["usuario"]+"</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>"+valor["fecha"]+"</span></div><div class='mensajeRecibido'>"+valor["mensaje"]+"</div></div></div>"));
                        }
                    });
                }
            });
        } else {
            let nombreUsuario=$("#usuarioOculto").text();
            let nombreTabla=$("#nombreTablaOculto").text();

            $.post("php/actualizarChatPrivado.php",{
                "nombreTabla":nombreTabla
            },function(respuesta) {
                if(respuesta=="0") {
                    $("main>div>div").remove();
                    $("main>div").append($("<div class='row'><div class='col s12 center-align'><p id='noMensajes'>No hay mensajes</p></div></div>"));
                } else {
                    $("main>div>div").remove();
                    let mensajes=JSON.parse(respuesta);
                    $.each(mensajes,function(clave,valor) {
                        if(valor["usuario"]==nombreUsuario) {
                            $("main>div").append($("<div class='row'><div class='contenedorEnviado'><div class='datosEnviado'><span>"+valor["usuario"]+"</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>"+valor["fecha"]+"</span></div><div class='mensajeEnviado'>"+valor["mensaje"]+"</div></div></div>"));
                        } else {
                            $("main>div").append($("<div class='row'><div class='contenedorRecibido'><div class='datosRecibido'><span>"+valor["nomApeProfesional"]+"<img class='profesionalStick' src='img/profesionalStick.png'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span>"+valor["fecha"]+"</span></div><div class='mensajeRecibido'>"+valor["mensaje"]+"</div></div></div>"));
                        }
                    });
                }
            });
        }
    }

    setTimeout(function() {
        setInterval(actualizarChatPrivado,1000);
    },1000);

    function comprobarPrivadoCerrado() {
        if($("#profesionalOculto").length>0) {
            var comprobarPropio=$("#profesionalOculto").text();
        } else {
            var comprobarPropio=$("#usuarioOculto").text();
        }

        $.post("php/comprobarChatPrivado.php",{
            "comprobarPropio":comprobarPropio
        },function(respuesta) {
            if(respuesta=="1") {
                window.location.href="principal.php";
            }
        });
    }
    setInterval(comprobarPrivadoCerrado,2000);
});