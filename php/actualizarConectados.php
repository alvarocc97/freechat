<?php
    if(isset($_REQUEST["nombreUsuario"])) {
        $totalConectados=array();
        $nombreUsuario=$_REQUEST["nombreUsuario"];
        require "conexion.php";
        $resultadoProfesionalesConectados=$conexion->query("SELECT nombre,apellidos,dni FROM profesionales WHERE conectado='S'");
        $resultadoProfesionalesConectadosFilas=$resultadoProfesionalesConectados->num_rows;
        if($resultadoProfesionalesConectadosFilas==0) {
            $resultadoUsuariosConectados=$conexion->query("SELECT nombre FROM usuarios WHERE conectado='S' AND nombre!='$nombreUsuario'");
            $resultadoUsuariosConectadosFilas=$resultadoUsuariosConectados->num_rows;
            if($resultadoUsuariosConectadosFilas==0) {
                echo "0";
            } else {
                $usuariosConectados=$resultadoUsuariosConectados->fetch_all(MYSQLI_ASSOC);
                $totalConectados["usuariosConectados"]=$usuariosConectados;
                echo json_encode($totalConectados);
            }
        } else {
            $profesionalesConectados=$resultadoProfesionalesConectados->fetch_all(MYSQLI_ASSOC);
            
            $resultadoUsuariosConectados=$conexion->query("SELECT nombre FROM usuarios WHERE conectado='S' AND nombre!='$nombreUsuario'");
            $resultadoUsuariosConectadosFilas=$resultadoUsuariosConectados->num_rows;
            if($resultadoUsuariosConectadosFilas==0) {
                $totalConectados["profesionalesConectados"]=$profesionalesConectados;
                echo json_encode($totalConectados);
            } else {
                $usuariosConectados=$resultadoUsuariosConectados->fetch_all(MYSQLI_ASSOC);
                $totalConectados["profesionalesConectadosTotal"]=$profesionalesConectados;
                $totalConectados["usuariosConectadosTotal"]=$usuariosConectados;
                echo json_encode($totalConectados);
            }
        }
    } elseif(isset($_REQUEST["dniUsuario"])) {
        $totalConectados=array();
        $dniUsuario=$_REQUEST["dniUsuario"];
        $dniCod=base64_encode($dniUsuario);
        require "conexion.php";
        $resultadoProfesionalesConectados=$conexion->query("SELECT nombre,apellidos,dni FROM profesionales WHERE conectado='S' AND dni!='$dniCod'");
        $resultadoProfesionalesConectadosFilas=$resultadoProfesionalesConectados->num_rows;
        if($resultadoProfesionalesConectadosFilas==0) {
            $resultadoUsuariosConectados=$conexion->query("SELECT nombre FROM usuarios WHERE conectado='S'");
            $resultadoUsuariosConectadosFilas=$resultadoUsuariosConectados->num_rows;
            if($resultadoUsuariosConectadosFilas==0) {
                echo "0";
            } else {
                $usuariosConectados=$resultadoUsuariosConectados->fetch_all(MYSQLI_ASSOC);
                $totalConectados["usuariosConectados"]=$usuariosConectados;
                echo json_encode($totalConectados);
            }
        } else {
            $profesionalesConectados=$resultadoProfesionalesConectados->fetch_all(MYSQLI_ASSOC);
            
            $resultadoUsuariosConectados=$conexion->query("SELECT nombre FROM usuarios WHERE conectado='S'");
            $resultadoUsuariosConectadosFilas=$resultadoUsuariosConectados->num_rows;
            if($resultadoUsuariosConectadosFilas==0) {
                $totalConectados["profesionalesConectados"]=$profesionalesConectados;
                echo json_encode($totalConectados);
            } else {
                $usuariosConectados=$resultadoUsuariosConectados->fetch_all(MYSQLI_ASSOC);
                $totalConectados["profesionalesConectadosTotal"]=$profesionalesConectados;
                $totalConectados["usuariosConectadosTotal"]=$usuariosConectados;
                echo json_encode($totalConectados);
            }
        }
    }
?>