<?php
    if(isset($_REQUEST["solicitado"])) {
        $solicitado=base64_encode($_REQUEST["solicitado"]);
        require "conexion.php";
        require "limpiarPeticionesZombies.php";

        $resultadoNotificaciones=$conexion->query("SELECT solicitado,solicitante,fecha,usuarios.imagen,profesionales.privadaActiva FROM peticiones INNER JOIN usuarios ON solicitante=nombre INNER JOIN profesionales ON solicitado=dni WHERE solicitado='$solicitado' ORDER BY fecha DESC");
        $resultadoNotificaciones=$resultadoNotificaciones->fetch_all(MYSQLI_ASSOC);
        $conexion->close();

        echo json_encode($resultadoNotificaciones);
    }
?>