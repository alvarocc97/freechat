<?php
    require "conexion.php";
    $resultadoChat=$conexion->query("SELECT usuario,fecha,mensaje,profesional,dni FROM mensajes");
    $resultadoChatFilas=$resultadoChat->num_rows;
    if($resultadoChatFilas==0) {
        echo "0";
    } else {
        while($fila=$resultadoChat->fetch_assoc()) {
            $fila["mensaje"]=base64_decode($fila["mensaje"]);
            $fila["dni"]=base64_decode($fila["dni"]);
            $chat[]=$fila;
        }
        echo json_encode($chat);
    }
    $conexion->close();
?>