<?php
    if(isset($_REQUEST["nombreUsuario"])) {
        $nombreUsuario=$_REQUEST["nombreUsuario"];
        require "conexion.php";
        $resultadoConectados=$conexion->query("SELECT nombre FROM usuarios WHERE conectado='S' AND nombre!='$nombreUsuario'");
        $resultadoConectadosFilas=$resultadoConectados->num_rows;
        if($resultadoConectadosFilas==0) {
            echo "0";
        } else {
            $conectados=$resultadoConectados->fetch_all(MYSQLI_ASSOC);
            echo json_encode($conectados);
        }
        $conexion->close();
    }
?>