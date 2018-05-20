$(function() {
    $("#entrarAut").button();
    $("#terminadoReg").button();

    $("#usuarioReg").keyup(function(evento) {
        let usuario=$(this).val();
        $.post("php/comprobarUsuario.php",{
            "usuario":usuario
        },function(respuesta) {
            if(usuario.length!=0) {
                if(respuesta=="0") {
                    $("#usuarioReg").css("border","2px solid green");
                } else {
                    $("#usuarioReg").css("border","2px solid red");
                }
            } else {
                $("#usuarioReg").css("border","none");
            }
        });
    });

    $("#dialogoRegistroCorrecto,#dialogoUsuarioExistente,#dialogoClavesDiferentes,#dialogoCaptchaIncorrecto,#datosIncorrectos,#dialogoDniNoPermitido").dialog({
        resizable:false,
    });

    $("#claveReg,#claveReg2").on("copy",function(evento) {
        evento.preventDefault();
    });

    $("#claveReg,#claveReg2").on("paste",function(evento) {
        evento.preventDefault();
    });
});