<?php
    $resultadoPeticionesZombiesUsuarios=$conexion->query("SELECT solicitante FROM peticiones WHERE solicitante NOT IN (SELECT nombre FROM usuarios)");
    $resultadoPeticionesZombiesUsuariosNum=$resultadoPeticionesZombiesUsuarios->num_rows;
    if($resultadoPeticionesZombiesUsuariosNum>0) {
        while($resultadoPeticionesZombiesUsuariosFila=$resultadoPeticionesZombiesUsuarios->fetch_row()) {
            $conexion->query("DELETE FROM peticiones WHERE solicitante='$resultadoPeticionesZombiesUsuariosFila[0]'");
        }
    }

    $resultadoPeticionesZombiesProfesionales=$conexion->query("SELECT solicitado FROM peticiones WHERE solicitado NOT IN (SELECT dni FROM profesionales)");
    $resultadoPeticionesZombiesProfesionalesNum=$resultadoPeticionesZombiesProfesionales->num_rows;
    if($resultadoPeticionesZombiesProfesionalesNum>0) {
        while($resultadoPeticionesZombiesProfesionalesFila=$resultadoPeticionesZombiesProfesionales->fetch_row()) {
            $conexion->query("DELETE FROM peticiones WHERE solicitado='$resultadoPeticionesZombiesProfesionalesFila[0]'");
        }
    }
?>