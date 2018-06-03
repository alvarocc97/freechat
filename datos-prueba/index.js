$(function() {
    $("#insertarDatos").click(function() {
        $.post("datosPrueba.php",function(respuesta) {
            if(respuesta=="1") {
                alert("DATOS INTRODUCIDOS");
                window.location.href="../index.php";
            }
        });
    });
});