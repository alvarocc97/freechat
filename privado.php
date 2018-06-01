<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <script src="jQuery/jquery-3.2.1.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/privado.js"></script>
    <link href="css/principal.css" rel="stylesheet">
    <link href="css/privado.css" rel="Stylesheet">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#cd69d6">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">
    <title>Conversación privada</title>
    <?php
        session_start();
        if(!isset($_SESSION["dniProfesional"]) && !isset($_SESSION["nombreUsuario"])) {
            header("Location: permisoDenegado.html");
        }
        if(isset($_SESSION["dniProfesional"])) {
            $nombreSolicitante=$_SESSION["nombreSolicitante"];
            $dniCod=base64_encode($_SESSION["dniProfesional"]);
            $dniSlug=str_replace("=","",$dniCod);

            require "php/conexion.php";
            $resultadoNombreTabla=$conexion->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE '%$dniSlug%'");
            $resultadoNombreTabla=$resultadoNombreTabla->fetch_row();

            $resultadoImagenSolicitante=$conexion->query("SELECT imagen FROM usuarios WHERE nombre='$nombreSolicitante'");
            $resultadoImagenSolicitante=$resultadoImagenSolicitante->fetch_row();
            $conexion->close();
        } else {
            $dniSolicitado=$_SESSION["dniSolicitado"];
            $nombreUsuario=$_SESSION["nombreUsuario"];

            require "php/conexion.php";
            $resultadoNombreTabla=$conexion->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE '%$nombreUsuario%'");
            $resultadoNombreTabla=$resultadoNombreTabla->fetch_row();

            $resultadoSolicitado=$conexion->query("SELECT nombre,apellidos,imagen FROM profesionales WHERE dni='$dniSolicitado'");
            $resultadoSolicitado=$resultadoSolicitado->fetch_assoc();
            $nomApeSolicitado=$resultadoSolicitado["nombre"]." ".$resultadoSolicitado["apellidos"];
            $imagenSolicitado=$resultadoSolicitado["imagen"];
            $conexion->close();
        }
    ?>
</head>
<body>
    <ul id="slide-out" class="side-nav fixed">
        <li><div class="user-view">
            <div class="background">
                <img src="img/fondoEncabezado.jpg">
            </div>
            <?php
            if(isset($_SESSION["dniProfesional"])) {
                ?>
                <a href="#" id="imagenUsuario"><img class="circle" src="<?php echo $resultadoImagenSolicitante[0]; ?>"></a>
                <span class="white-text name">Conversación privada con:</span>
                <a href="#" id="nombreUsuario"><span class="white-text name"><?php echo $nombreSolicitante; ?></span></a>
                <span class="hide" id="profesionalOculto"><?php echo $dniCod; ?></span>
                <?php
            } else {
                ?>
                <a href="#" id="imagenUsuario"><img class="circle" src="<?php echo $imagenSolicitado; ?>"></a>
                <span class="white-text name">Conversación privada con:</span>
                <a href="#" id="nombreUsuario"><span class="white-text name" idProf="<?php echo $dniSolicitado; ?>"><?php echo $nomApeSolicitado; ?><img class="profesionalStick" src="img/profesionalStick.png"></span></a>
                <span class="hide" id="usuarioOculto"><?php echo $nombreUsuario; ?></span>
                <?php
            }
            ?>
            <span class="hide" id="nombreTablaOculto"><?php echo $resultadoNombreTabla[0]; ?></span>
        </div></li>
    </ul>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    <header>
            
    </header>
    <main>
        <div class="container">
            <?php
                require "php/conexion.php";
                $resultadoChat=$conexion->query("SELECT usuario,profesional,fecha,mensaje FROM $resultadoNombreTabla[0]");
                $resultadoChatFilas=$resultadoChat->num_rows;
                if($resultadoChatFilas==0) {
                    ?>
                    <div class="row">
                        <div class="col s12 center-align">
                            <p id="noMensajes">No hay mensajes</p>
                        </div>
                    </div>
                    <?php
                } else {
                    if(isset($_SESSION["dniProfesional"])) {
                        while($fila=$resultadoChat->fetch_assoc()) {
                            if($fila["profesional"]!=NULL) {
                                $dni=$fila["profesional"];
            
                                $resultadoNomApeProfesional=$conexion->query("SELECT nombre,apellidos FROM profesionales WHERE dni='$dni'");
                                $resultadoNomApeProfesional=$resultadoNomApeProfesional->fetch_assoc();
                                $nomApeProfesional=$resultadoNomApeProfesional["nombre"]." ".$resultadoNomApeProfesional["apellidos"];
                            }

                            if($fila["profesional"]==$dniCod) {
                                ?>
                                <div class='row'>
                                    <div class='contenedorEnviado'>
                                        <div class='datosEnviado'>
                                            <span><?php echo $nomApeProfesional; ?><img class="profesionalStick" src="img/profesionalStick.png"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $fila["fecha"]; ?></span>
                                        </div>
                                        <div class='mensajeEnviado'><?php echo base64_decode($fila["mensaje"]); ?></div>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class='row'>
                                    <div class='contenedorRecibido'>
                                        <div class='datosRecibido'>
                                            <span><?php echo $fila["usuario"]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $fila["fecha"]; ?></span>
                                        </div>
                                        <div class='mensajeRecibido'><?php echo base64_decode($fila["mensaje"]); ?></div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    } else {
                        while($fila=$resultadoChat->fetch_assoc()) {
                            if($fila["profesional"]!=NULL) {
                                $dni=$fila["profesional"];
            
                                $resultadoNomApeProfesional=$conexion->query("SELECT nombre,apellidos FROM profesionales WHERE dni='$dni'");
                                $resultadoNomApeProfesional=$resultadoNomApeProfesional->fetch_assoc();
                                $nomApeProfesional=$resultadoNomApeProfesional["nombre"]." ".$resultadoNomApeProfesional["apellidos"];
                            }

                            if($fila["usuario"]==$nombreUsuario) {
                                ?>
                                <div class='row'>
                                    <div class='contenedorEnviado'>
                                        <div class='datosEnviado'>
                                            <span><?php echo $fila["usuario"]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $fila["fecha"]; ?></span>
                                        </div>
                                        <div class='mensajeEnviado'><?php echo base64_decode($fila["mensaje"]); ?></div>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class='row'>
                                    <div class='contenedorRecibido'>
                                        <div class='datosRecibido'>
                                            <span><?php echo $nomApeProfesional; ?><img class="profesionalStick" src="img/profesionalStick.png"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $fila["fecha"]; ?></span>
                                        </div>
                                        <div class='mensajeRecibido'><?php echo base64_decode($fila["mensaje"]); ?></div>
                                    </div>
                                </div>
                                <?php 
                            }
                        }
                    }
                }
                $conexion->close();
            ?>
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="input-field col s10">
                    <input type="text" id="mensajeUsuario" maxlength="280" data-length="280" placeholder="Escribir mensaje">
                </div>
                <div class="col s2" id="botonEnviarCont">
                    <button id="botonEnviar" class="waves-effect waves-light waves-purple btn-flat" disabled><i class="material-icons">send</i></button>
                </div>
            </div>
        </div>
    </footer>
    <?php require "php/salirPrivado.php"; ?>
</body>
</html>