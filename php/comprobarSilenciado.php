<?php
    if(isset($_REQUEST["dniUsuario"])) {
        $dniUsuario=base64_encode($_REQUEST["dniUsuario"]);

        require "conexion.php";
        $resultadoSilenciadoProfesional=$conexion->query("SELECT silenciado FROM profesionales WHERE dni='$dniUsuario'");
        $resultadoSilenciadoProfesional=$resultadoSilenciadoProfesional->fetch_row();
        $conexion->close();

        if($resultadoSilenciadoProfesional[0]=="N") {
            echo "0";
        } else {
            echo "1";
        }
    } else {
        $nombreUsuario=$_REQUEST["nombreUsuario"];

        require "conexion.php";
        $resultadoSilenciadoUsuario=$conexion->query("SELECT silenciado FROM usuarios WHERE nombre='$nombreUsuario'");
        $resultadoSilenciadoUsuario=$resultadoSilenciadoUsuario->fetch_row();
        $conexion->close();

        if($resultadoSilenciadoUsuario[0]=="N") {
            echo "0";
        } else {
            echo "1";
        }
    }
?>