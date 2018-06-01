<?php
    if(isset($_REQUEST["solicitado"]) && isset($_REQUEST["solicitante"])) {
        $solicitado=base64_encode($_REQUEST["solicitado"]);
        $solicitadoSlug=str_replace("=","",base64_encode($_REQUEST["solicitado"]));
        $solicitante=$_REQUEST["solicitante"];
        require "conexion.php";
        $resultadoConectado=$conexion->query("SELECT conectado FROM usuarios WHERE nombre='$solicitante'");
        $resultadoConectado=$resultadoConectado->fetch_row();
        if($resultadoConectado[0]=="S") {
            if($conexion->query("DELETE FROM peticiones WHERE solicitante='$solicitante'")) {
                $nombreTabla=$solicitadoSlug."_".$solicitante;
                $sql="CREATE TABLE IF NOT EXISTS $nombreTabla (";
                $sql.="id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,";
                $sql.="usuario VARCHAR(50) NULL,";
                $sql.="profesional VARCHAR(100) NULL,";
                $sql.="fecha DATETIME NOT NULL,";
                $sql.="mensaje TEXT NOT NULL)";
    
                if($conexion->query($sql)) {
                    $conexion->query("UPDATE usuarios SET privadaActiva='S' WHERE nombre='$solicitante'");
                    $conexion->query("UPDATE profesionales SET privadaActiva='S' WHERE dni='$solicitado'");

                    session_start();
                    $_SESSION["nombreSolicitante"]=$solicitante;

                    echo "1";
                } else {
                    echo $conexion->error;
                }
            } else {
                echo $conexion->error;
            }
        } else {
            echo "0";
        }
        $conexion->close();
    }
?>