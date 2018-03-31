<?php
    if(isset($_REQUEST["usuario"])) {
        require "conexion.php";
        $sql="SELECT nombre FROM usuarios WHERE nombre='".$_REQUEST["usuario"]."'";
        $resultado=$conexion->query($sql);
        $resultadoFilas=$resultado->num_rows;
        if($resultadoFilas==0) {
            echo "0";
        } else {
            echo "1";
        }

        $conexion->close();
    }
?>