<?php
    if(isset($_REQUEST["nombreUsuario"])) {
        $nombreUsuario=$_REQUEST["nombreUsuario"];
        require "conexion.php";
        if($conexion->query("UPDATE usuarios SET conectado='N' WHERE nombre='$nombreUsuario'")) {
            echo "1";
        } else {
            echo "0";
        }
        $conexion->close();
    } elseif(isset($_REQUEST["dniUsuario"])) {
        $dniUsuario=$_REQUEST["dniUsuario"];
        $dniCod=base64_encode($dniUsuario);
        require "conexion.php";
        if($conexion->query("UPDATE profesionales SET conectado='N' WHERE dni='$dniCod'")) {
            echo "1";
        } else {
            echo "0";
        }
        $conexion->close();
    }
?>