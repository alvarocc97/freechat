<?php
    if(isset($_REQUEST["solicitado"]) && isset($_REQUEST["solicitante"])) {
        $solicitado=$_REQUEST["solicitado"];
        $solicitante=$_REQUEST["solicitante"];

        require "conexion.php";

        $resultadoPrivada=$conexion->query("SELECT privadaActiva FROM usuarios WHERE nombre='$solicitante'");
        $resultadoPrivada=$resultadoPrivada->fetch_row();
        if($resultadoPrivada[0]=="N") {
            $resultadoYaSolicitado=$conexion->query("SELECT * FROM peticiones WHERE solicitado='$solicitado' AND solicitante='$solicitante'");
            $resultadoYaSolicitadoNum=$resultadoYaSolicitado->num_rows;
            if($resultadoYaSolicitadoNum==0) {
                $resultadoPeticiones=$conexion->query("SELECT * FROM peticiones WHERE solicitante='$solicitante'");
                $resultadoPeticionesNum=$resultadoPeticiones->num_rows;
                if($resultadoPeticionesNum==0) {
                    if($conexion->query("INSERT INTO peticiones (solicitado,solicitante,fecha) VALUES ('$solicitado','$solicitante',NOW())")) {
                        session_start();
                        $_SESSION["dniSolicitado"]=$solicitado;
                        
                        echo "1";
                    } else {
                        echo $conexion->error;
                    }
                } else {
                    echo "3";
                }
            } else {
                echo "2";
            }
        } else {
            echo "0";
        }
        
    }
?>