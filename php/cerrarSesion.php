<?php
    if(isset($_REQUEST["nombreUsuario"])) {
        $nombreUsuario=$_REQUEST["nombreUsuario"];
        require "conexion.php";
        if($conexion->query("UPDATE usuarios SET conectado='N' WHERE nombre='$nombreUsuario'")) {
            session_start();
            $_SESSION=array();
            session_destroy();

            echo "1";
        } else {
            echo $conexion->error;
        }
        $conexion->close();
    } elseif(isset($_REQUEST["dniUsuario"])) {
        $dniUsuario=$_REQUEST["dniUsuario"];
        $dniCod=base64_encode($dniUsuario);
        require "conexion.php";
        if($conexion->query("UPDATE profesionales SET conectado='N' WHERE dni='$dniCod'")) {
            session_start();
            $_SESSION=array();
            session_destroy();

            echo "1";
        } else {
            echo $conexion->error;
        }
        $conexion->close();
    }
?>