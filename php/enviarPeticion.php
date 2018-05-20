<?php
    if(isset($_REQUEST["solicitado"]) && isset($_REQUEST["solicitante"])) {
        $solicitado=$_REQUEST["solicitado"];
        $solicitante=$_REQUEST["solicitante"];

        if(preg_match("/^[0-9]{8}-[TRWAGMYFPDXBNJZSQVHLCKE]$/i",$solicitante)) {
            $solicitante=base64_encode($solicitante);
        }

        require "conexion.php";
        $resultadoPeticiones=$conexion->query("SELECT * FROM peticiones WHERE solicitado='$solicitado' AND solicitante='$solicitante'");
        $resultadoPeticionesNum=$resultadoPeticiones->num_rows;
        if($resultadoPeticionesNum==0) {
            if($conexion->query("INSERT INTO peticiones (solicitado,solicitante) VALUES ('$solicitado','$solicitante')")) {
                echo "1";
            } else {
                echo "0";
            }
        } else {
            echo "2";
        }
    }
?>