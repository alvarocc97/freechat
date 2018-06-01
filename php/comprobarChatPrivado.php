<?php
    if(isset($_REQUEST["solicitante"])) {
        $solicitante=$_REQUEST["solicitante"];
        require "conexion.php";
        $resultadoNombreTabla=$conexion->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE '%$solicitante%'");
        $resultadoNombreTablaNum=$resultadoNombreTabla->num_rows;
        $conexion->close();
        if($resultadoNombreTablaNum>0) {
            echo "1";
        }
    } elseif(isset($_REQUEST["comprobarPropio"])) {
        $comprobarPropio=$_REQUEST["comprobarPropio"];
        $comprobarPropio=str_replace("=","",$comprobarPropio);
        require "conexion.php";
        $resultadoNombreTabla=$conexion->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE '%$comprobarPropio%'");
        $resultadoNombreTablaNum=$resultadoNombreTabla->num_rows;
        $conexion->close();
        if($resultadoNombreTablaNum==0) {
            echo "1";
        }
    }
?>