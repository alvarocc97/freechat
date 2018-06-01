<?php
    if($_REQUEST["nombreTabla"]) {
        $nombreTabla=$_REQUEST["nombreTabla"];
        require "conexion.php";

        $resultadoChat=$conexion->query("SELECT usuario,profesional,fecha,mensaje FROM $nombreTabla");
        $resultadoChatFilas=$resultadoChat->num_rows;
        if($resultadoChatFilas==0) {
            echo "0";
        } else {
            while($fila=$resultadoChat->fetch_assoc()) {
                $fila["mensaje"]=base64_decode($fila["mensaje"]);
                if($fila["profesional"]!=NULL) {
                    $dni=$fila["profesional"];

                    $nomApeProfesional=$conexion->query("SELECT nombre,apellidos FROM profesionales WHERE dni='$dni'");
                    $nomApeProfesional=$nomApeProfesional->fetch_assoc();
                    $fila["nomApeProfesional"]=$nomApeProfesional["nombre"]." ".$nomApeProfesional["apellidos"];
                }
                $chat[]=$fila;
            }
            echo json_encode($chat);
        }
        $conexion->close();
    } 
?>