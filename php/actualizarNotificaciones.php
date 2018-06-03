<?php
    if(isset($_REQUEST["dniProfesional"])) {
        $dniProfesional=$_REQUEST["dniProfesional"];
        $dniCod=base64_encode($dniProfesional);

        require "conexion.php";
        $resultadoNotificaciones=$conexion->query("SELECT * FROM peticiones INNER JOIN usuarios ON peticiones.solicitante=usuarios.nombre WHERE solicitado='$dniCod'");
        $resultadoNotificacionesNum=$resultadoNotificaciones->num_rows;
        $respuesta[]=$resultadoNotificacionesNum;

        $resultadoOculto=$conexion->query("SELECT oculto FROM profesionales WHERE dni='$dniCod'");
        $resultadoOculto=$resultadoOculto->fetch_row();
        $respuesta[]=$resultadoOculto[0];
        $conexion->close();

        
        echo json_encode($respuesta);
    }
?>