<?php
    if(isset($_REQUEST["usuario"]) && isset($_REQUEST["mensaje"])) {
        $usuario=$_REQUEST["usuario"];
        $mensaje=$_REQUEST["mensaje"];

        $mensajeCodificado=base64_encode($mensaje);

        require "conexion.php";
        if($conexion->query("INSERT INTO mensajes (usuario,fecha,mensaje,profesional,dni) VALUES ('$usuario',NOW(),'$mensajeCodificado','N',NULL)")) {
            echo "1";
        } else {
            echo $conexion->error;
        }
        $conexion->close();
    } else {
        $dniUsuario=$_REQUEST["dni"];
        $mensaje=$_REQUEST["mensaje"];

        $dniCod=base64_encode($dniUsuario);
        $mensajeCodificado=base64_encode($mensaje);

        require "conexion.php";

        $nombreApellidos=$conexion->query("SELECT nombre,apellidos FROM profesionales WHERE dni='$dniCod'");
        $nombreApellidosFila=$nombreApellidos->fetch_row();
        
        if($conexion->query("INSERT INTO mensajes (usuario,fecha,mensaje,profesional,dni) VALUES ('$nombreApellidosFila[0] $nombreApellidosFila[1]',NOW(),'$mensajeCodificado','S','$dniCod')")) {
            echo "1";
        } else {
            echo "0";
        }
        $conexion->close();
    }
?>