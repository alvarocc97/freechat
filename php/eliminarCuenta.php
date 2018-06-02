<?php
    if(isset($_REQUEST["dniProfesional"])) {
        $dniProfesional=$_REQUEST["dniProfesional"];

        require "conexion.php";
        if($conexion->query("DELETE FROM profesionales WHERE dni='$dniProfesional'")) {
            if(file_exists("../img/imagenes-perfil/".$dniProfesional.".jpg")) {
                unlink("../img/imagenes-perfil/".$dniProfesional.".jpg");
            }
            if(file_exists("../img/imagenes-perfil/".$dniProfesional.".jpeg")) {
                unlink("../img/imagenes-perfil/".$dniProfesional.".jpeg");
            }
            if(file_exists("../img/imagenes-perfil/".$dniProfesional.".png")) {
                unlink("../img/imagenes-perfil/".$dniProfesional.".png");
            }
            
            session_start();
            $_SESSION=array();
            session_destroy();

            echo "1";
        } else {
            echo $conexion->error;
        }
    } else {
        $nombreUsuario=$_REQUEST["nombreUsuario"];

        require "conexion.php";
        if($conexion->query("DELETE FROM usuarios WHERE nombre='$nombreUsuario'")) {
            if(file_exists("../img/imagenes-perfil/".$nombreUsuario.".jpg")) {
                unlink("../img/imagenes-perfil/".$nombreUsuario.".jpg");
            }
            if(file_exists("../img/imagenes-perfil/".$nombreUsuario.".jpeg")) {
                unlink("../img/imagenes-perfil/".$nombreUsuario.".jpeg");
            }
            if(file_exists("../img/imagenes-perfil/".$nombreUsuario.".png")) {
                unlink("../img/imagenes-perfil/".$nombreUsuario.".png");
            }
            
            session_start();
            $_SESSION=array();
            session_destroy();

            echo "1";
        } else {
            echo $conexion->error;
        }
    }
?>