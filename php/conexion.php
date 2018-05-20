<?php
     $conexion=new mysqli("localhost","root","","freechat");
     if($conexion->errno) {
         die("Se ha producido un error: ".$conexion->error);
     } else {
         $conexion->set_charset("utf8");
     }
?>