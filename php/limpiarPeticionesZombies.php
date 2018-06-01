<?php
     $resultadoPeticionesZombies=$conexion->query("SELECT solicitante FROM peticiones WHERE solicitante NOT IN (SELECT nombre FROM usuarios)");
     $resultadoPeticionesZombiesNum=$resultadoPeticionesZombies->num_rows;
     if($resultadoPeticionesZombiesNum>0) {
         while($resultadoPeticionesZombiesFila=$resultadoPeticionesZombies->fetch_row()) {
             $conexion->query("DELETE FROM peticiones WHERE solicitante='$resultadoPeticionesZombiesFila[0]'");
         }
     }
?>