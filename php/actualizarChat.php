<?php
    require "conexion.php";
    $resultadoChat=$conexion->query("SELECT usuario,fecha,mensaje FROM mensajes");
    $resultadoChatFilas=$resultadoChat->num_rows;
    if($resultadoChatFilas==0) {
        echo "0";
    } else {
        // $chat=$resultadoChat->fetch_all(MYSQLI_ASSOC);
        // echo json_encode($chat);
        while($fila=$resultadoChat->fetch_assoc()) {
            $fila["mensaje"]=base64_decode($fila["mensaje"]);
            $chat[]=$fila;
        }
        echo json_encode($chat);
    }
    $conexion->close();
?>