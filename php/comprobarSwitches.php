<?php
    if(isset($_REQUEST["dniProfesional"])) {
        $dniProfesional=$_REQUEST["dniProfesional"];

        require "conexion.php";
        $resultadoSwitchesProfesional=$conexion->query("SELECT silenciado,oculto FROM profesionales WHERE dni='$dniProfesional'");
        $resultadoSwitchesProfesional=$resultadoSwitchesProfesional->fetch_assoc();
        $conexion->close();

        if($resultadoSwitchesProfesional["silenciado"]=="N" && $resultadoSwitchesProfesional["oculto"]=="N") {
            echo "0";
        } elseif($resultadoSwitchesProfesional["silenciado"]=="N" && $resultadoSwitchesProfesional["oculto"]=="S") {
            echo "1";
        } elseif($resultadoSwitchesProfesional["silenciado"]=="S" && $resultadoSwitchesProfesional["oculto"]=="N") {
            echo "2";
        } elseif($resultadoSwitchesProfesional["silenciado"]=="S" && $resultadoSwitchesProfesional["oculto"]=="S") {
            echo "3";
        }
    } else {
        $nombreUsuario=$_REQUEST["nombreUsuario"];

        require "conexion.php";
        $resultadoSwitchesUsuario=$conexion->query("SELECT silenciado,oculto FROM usuarios WHERE nombre='$nombreUsuario'");
        $resultadoSwitchesUsuario=$resultadoSwitchesUsuario->fetch_assoc();
        $conexion->close();

        if($resultadoSwitchesUsuario["silenciado"]=="N" && $resultadoSwitchesUsuario["oculto"]=="N") {
            echo "0";
        } elseif($resultadoSwitchesUsuario["silenciado"]=="N" && $resultadoSwitchesUsuario["oculto"]=="S") {
            echo "1";
        } elseif($resultadoSwitchesUsuario["silenciado"]=="S" && $resultadoSwitchesUsuario["oculto"]=="N") {
            echo "2";
        } elseif($resultadoSwitchesUsuario["silenciado"]=="S" && $resultadoSwitchesUsuario["oculto"]=="S") {
            echo "3";
        }
    }
?>