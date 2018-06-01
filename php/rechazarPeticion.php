<?php
    if(isset($_REQUEST["solicitado"]) && isset($_REQUEST["solicitante"])) {
        $solicitado=base64_encode($_REQUEST["solicitado"]);
        $solicitante=$_REQUEST["solicitante"];
        require "conexion.php";
        if($conexion->query("DELETE FROM peticiones WHERE solicitado='$solicitado' AND solicitante='$solicitante'")) {
            echo "1";
        } else {
            echo $conexion->error;
        }
        $conexion->close();
    }
?>