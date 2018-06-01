<?php
    if(isset($_REQUEST["dniProfesional"]) && isset($_REQUEST["nombreUsuario"]) && isset($_REQUEST["nombreTabla"])) {
        $dniProfesional=$_REQUEST["dniProfesional"];
        $nombreUsuario=$_REQUEST["nombreUsuario"];
        $nombreTabla=$_REQUEST["nombreTabla"];

        require "conexion.php";
        if($conexion->query("DROP TABLE $nombreTabla")) {
            $conexion->query("UPDATE usuarios SET privadaActiva='N' WHERE nombre='$nombreUsuario'");
            $conexion->query("UPDATE profesionales SET privadaActiva='N' WHERE dni='$dniProfesional'");

            echo "1";
        } else {
            echo $conexion->error;
        }
    }
?>