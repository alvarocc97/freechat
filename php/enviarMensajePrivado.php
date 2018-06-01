<?php
    if(isset($_REQUEST["dniProfesional"]) && isset($_REQUEST["mensajeProfesional"]) && isset($_REQUEST["nombreTabla"])) {
        $profesional=$_REQUEST["dniProfesional"];
        $mensaje=$_REQUEST["mensajeProfesional"];
        $nombreTabla=$_REQUEST["nombreTabla"];

        $mensajeCodificado=base64_encode($mensaje);

        require "conexion.php";
        if($conexion->query("INSERT INTO $nombreTabla (usuario,profesional,fecha,mensaje) VALUES (NULL,'$profesional',NOW(),'$mensajeCodificado')")) {
            echo "1";
        } else {
            echo $conexion->error;
        }
        $conexion->close();
    } else {
        $usuario=$_REQUEST["nombreUsuario"];
        $mensaje=$_REQUEST["mensajeUsuario"];
        $nombreTabla=$_REQUEST["nombreTabla"];

        $mensajeCodificado=base64_encode($mensaje);

        require "conexion.php";
        if($conexion->query("INSERT INTO $nombreTabla (usuario,profesional,fecha,mensaje) VALUES ('$usuario',NULL,NOW(),'$mensajeCodificado')")) {
            echo "1";
        } else {
            echo $conexion->error;
        }
        $conexion->close();
    }
?>