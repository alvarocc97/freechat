<?php
    if(isset($_REQUEST["dniProfesional"])) {
        $dniProfesional=$_REQUEST["dniProfesional"];
        $dniCod=base64_encode($dniProfesional);

        require "conexion.php";
        $resultadoNotificaciones=$conexion->query("SELECT * FROM peticiones WHERE solicitado='$dniCod'");
        $resultadoNotificacionesNum=$resultadoNotificaciones->num_rows;
        $conexion->close();

        echo $resultadoNotificacionesNum;
    }
?>