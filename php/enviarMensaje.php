<?php
    if(isset($_REQUEST["usuario"]) && isset($_REQUEST["mensaje"])) {
        $usuario=$_REQUEST["usuario"];
        $mensaje=$_REQUEST["mensaje"];

        $mensajeCodificado=base64_encode($mensaje);

        require "conexion.php";
        if($conexion->query("INSERT INTO mensajes (usuario,fecha,mensaje) VALUES ('$usuario',NOW(),'$mensajeCodificado')")) {
            echo "1";
        } else {
            echo "0";
        }
        $conexion->close();
    }
?>