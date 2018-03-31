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
    });

    $("#botonConfiguracion").click(function() {
        window.location.href="configuracion.php";
    });

    function actualizarConectados() {
        let nombreUsuario=$("title").text();
        $.post("php/actualizarConectados.php",{
            "nombreUsuario":nombreUsuario
        },function(respuesta) {
            if(respuesta=="0") {
                $("#slide-out>li:nth-child(n+3)").remove();
                $("#slide-out").append("<li><div class='center-align'>No hay ningún usuario conectado</div></li>");
            } else {
                $("#slide-out>li:nth-child(n+3)").remove();
                let conectados=JSON.parse(respuesta);
                $.each(conectados,function(clave,valor) {
                    $("#slide-out").append("<li><div class='center-align'>"+valor["nombre"]+"</div></li>"); 
                })
            }
        })
    }

    setTimeout(function() {
        setInterval(actualizarConectados,2000);
    },2000);

    function actualizarChat() {
        let nombreUsuario=$("title").text();
        $.post("php/actualizarChat.php",function(respuesta) {
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
                        $("main>div").append($("<div class='row'><div class='contenedorRecibido'><div class='datosRecibido'><span>"+valor["usuario"]+"</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>"+valor["fecha"]+"</span></div><div class='mensajeRecibido'>"+valor["mensaje"]+"</div></div></div>"));
                    }
                });
            }
        });
    }

    setInterval(actualizarChat,1000);

    $("#botonEnviar").click(function() {
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
    
});