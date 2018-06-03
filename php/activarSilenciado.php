<?php
    if(isset($_REQUEST["dniProfesional"])) {
        $dniProfesional=$_REQUEST["dniProfesional"];

        require "conexion.php";
        if($conexion->query("UPDATE profesionales SET silenciado='S' WHERE dni='$dniProfesional'")) {
            echo "1";
        } else {
            echo $conexion->error;
        }
        $conexion->close();
    } else {
        $nombreUsuario=$_REQUEST["nombreUsuario"];

        require "conexion.php";
        if($conexion->query("UPDATE usuarios SET silenciado='S' WHERE nombre='$nombreUsuario'")) {
            echo "1";
        } else {
            echo $conexion->error;
        }
        $conexion->close();
    }
?>