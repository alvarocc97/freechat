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
    }
?>