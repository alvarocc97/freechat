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
    <script src="js/principal.js"></script>
    <link href="css/principal.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#cd69d6">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">
    <?php
        session_start();
        if(!isset($_SESSION["dniProfesional"]) && !isset($_SESSION["nombreUsuario"])) {
            header("Location: permisoDenegado.html");
        }
        if(isset($_SESSION["dniProfesional"])) {
            $dniCod=base64_encode($_SESSION["dniProfesional"]);
            require "php/conexion.php";
            $resultado=$conexion->query("SELECT nombre,apellidos,dni,imagen FROM profesionales WHERE dni='$dniCod'");
            $fila=$resultado->fetch_row();
            $nombreUsuario=$fila[0]." ".$fila[1];
            $dniUsuario=$fila[2];
            $imagenUsuario=$fila[3];

            require "php/limpiarPeticionesZombies.php";
            $resultadoNotificaciones=$conexion->query("SELECT * FROM peticiones WHERE solicitado='$dniUsuario' ORDER BY fecha DESC");
            $resultadoNotificacionesNum=$resultadoNotificaciones->num_rows;
            $conexion->close();

            if($resultadoNotificacionesNum>0) {
                ?>
                <title><?php echo $nombreUsuario; ?> (<?php echo $resultadoNotificacionesNum; ?>)</title>
                <?php
            } else {
                ?>
                <title><?php echo $nombreUsuario; ?></title>
                <?php
            }
            require "php/modalPeticiones.php";
            
            require "php/conexion.php";
            $resultadoSilenciadoOculto=$conexion->query("SELECT silenciado,oculto FROM profesionales WHERE dni='$dniCod'");
            $resultadoSilenciadoOculto=$resultadoSilenciadoOculto->fetch_row();
            $conexion->close();
        } else {
            $nombreUsuario=$_SESSION["nombreUsuario"];
            require "php/conexion.php";
            $resultadoImagen=$conexion->query("SELECT imagen FROM usuarios WHERE nombre='$nombreUsuario'");
            $filaImagen=$resultadoImagen->fetch_row();
            $imagenUsuario=$filaImagen[0];
            $conexion->close();
            ?>
            <title><?php echo $nombreUsuario; ?></title>
            <?php

            require "php/conexion.php";
            $resultadoSilenciadoOculto=$conexion->query("SELECT silenciado,oculto FROM usuarios WHERE nombre='$nombreUsuario'");
            $resultadoSilenciadoOculto=$resultadoSilenciadoOculto->fetch_row();
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
            <a href="#" id="imagenUsuario"><img class="circle" src="<?php echo $imagenUsuario; ?>"></a>
            <?php
                if(isset($_SESSION["dniProfesional"])) {
                    if($resultadoNotificacionesNum>0) {
                        if($resultadoNotificacionesNum==1) {
                            if($resultadoSilenciadoOculto[1]=="N") {
                                ?>
                                <a href="#" id="nombreUsuario"><span class="white-text name"><?php echo $nombreUsuario; ?><img class="profesionalStick" src="img/profesionalStick.png"><a id="peticiones-trigger" href="#modalPeticiones" class="modal-trigger"><span class="new badge" data-badge-caption="petición"><?php echo $resultadoNotificacionesNum; ?></span></a></span></a>
                                <?php
                            } else {
                                ?>
                                <a href="#" id="nombreUsuario"><span class="white-text name"><?php echo $nombreUsuario; ?><img class="profesionalStick" src="img/profesionalStick.png"><i class="material-icons" title="Permaneces oculto para el resto de usuarios">visibility_off</i><a id="peticiones-trigger" href="#modalPeticiones" class="modal-trigger"><span class="new badge" data-badge-caption="petición"><?php echo $resultadoNotificacionesNum; ?></span></a></span></a>
                                <?php 
                            }
                        } else {
                            if($resultadoSilenciadoOculto[1]=="N") {
                                ?>
                                <a href="#" id="nombreUsuario"><span class="white-text name"><?php echo $nombreUsuario; ?><img class="profesionalStick" src="img/profesionalStick.png"><a id="peticiones-trigger" href="#modalPeticiones" class="modal-trigger"><span class="new badge" data-badge-caption="peticiones"><?php echo $resultadoNotificacionesNum; ?></span></a></span></a>
                                <?php  
                            } else {
                                ?>
                                <a href="#" id="nombreUsuario"><span class="white-text name"><?php echo $nombreUsuario; ?><img class="profesionalStick" src="img/profesionalStick.png"><i class="material-icons" title="Permaneces oculto para el resto de usuarios">visibility_off</i><a id="peticiones-trigger" href="#modalPeticiones" class="modal-trigger"><span class="new badge" data-badge-caption="peticiones"><?php echo $resultadoNotificacionesNum; ?></span></a></span></a>
                                <?php  
                            }
                        }
                    } else {
                        if($resultadoSilenciadoOculto[1]=="N") {
                            ?>
                            <a href="#" id="nombreUsuario"><span class="white-text name"><?php echo $nombreUsuario; ?><img class="profesionalStick" src="img/profesionalStick.png"></span></a>
                            <?php
                        } else {
                            ?>
                            <a href="#" id="nombreUsuario"><span class="white-text name"><?php echo $nombreUsuario; ?><img class="profesionalStick" src="img/profesionalStick.png"><i class="material-icons" title="Permaneces oculto para el resto de usuarios">visibility_off</i></span></a>
                            <?php
                        }
                    }
                    ?>
                    <a href="#" id="dniUsuario"><span class="white-text email"><?php echo base64_decode($dniUsuario); ?></span></a>
                    <?php
                } else {
                    if($resultadoSilenciadoOculto[1]=="N") {
                        ?>
                        <a href="#" id="nombreUsuario"><span class="white-text name"><?php echo $nombreUsuario; ?></span></a>
                        <?php
                    } else {
                        ?>
                        <a href="#" id="nombreUsuario"><span class="white-text name"><?php echo $nombreUsuario; ?><i class="material-icons" title="Permaneces oculto para el resto de usuarios">visibility_off</i></span></a>
                        <?php
                    } 
                }
            ?>
        </div></li>
        <li><div class="center-align" id="tituloProfesionalesConectados">Profesionales conectados</div></li>
        <?php
            require "php/conexion.php";
            if(isset($_SESSION["dniProfesional"])) {
                $resultadoProfesionalesConectados=$conexion->query("SELECT nombre,apellidos,dni FROM profesionales WHERE conectado='S' AND oculto='N' AND dni!='$dniCod'");
            } else {
                $resultadoProfesionalesConectados=$conexion->query("SELECT nombre,apellidos,dni FROM profesionales WHERE conectado='S' AND oculto='N'");
            }
            $resultadoProfesionalesConectadosFilas=$resultadoProfesionalesConectados->num_rows;
            if($resultadoProfesionalesConectadosFilas==0) {
                ?>
                <li><div class="center-align">No hay ningún profesional conectado</div></li>
                <?php
            } else {
                while($nombreApellidosDni=$resultadoProfesionalesConectados->fetch_row()) {
                    if(isset($_SESSION["dniProfesional"])) {
                        ?>
                        <li><div class="center-align"><?php echo $nombreApellidosDni[0]." ".$nombreApellidosDni[1]; ?><img class="profesionalStick" src="img/profesionalStick.png"></div></li>
                        <?php 
                    } else {
                        ?>
                        <li><div class="center-align profesional" idProf="<?php echo $nombreApellidosDni[2]; ?>"><?php echo $nombreApellidosDni[0]." ".$nombreApellidosDni[1]; ?><img class="profesionalStick" src="img/profesionalStick.png"></div></li>
                        <?php 
                    }
                }
            }
            ?><li><div class="center-align" id="tituloUsuariosConectados">Usuarios conectados</div></li><?php
            $resultadoUsuariosConectados=$conexion->query("SELECT nombre FROM usuarios WHERE conectado='S' AND oculto='N' AND nombre!='$nombreUsuario'");
            $resultadoUsuariosConectadosFilas=$resultadoUsuariosConectados->num_rows;
            if($resultadoUsuariosConectadosFilas==0) {
                ?>
                <li><div class="center-align">No hay ningún usuario conectado</div></li>
                <?php
            } else {
                while($nombre=$resultadoUsuariosConectados->fetch_row()) {
                    ?>
                    <li><div class="center-align"><?php echo $nombre[0]; ?></div></li>
                    <?php
                }
            }
            $conexion->close();
        ?>
        <button id="botonConfiguracion" class="waves-effect waves-light waves-purple btn-flat btn-large"><i class="material-icons">settings</i></button>
    </ul>
    <?php
    if(isset($_SESSION["dniProfesional"])) {
        if($resultadoNotificacionesNum>0) {
            ?>
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i><span class="badge-collapse"><?php echo $resultadoNotificacionesNum; ?></span></a>
            <?php
        } else {
            ?>
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
            <?php
        }
    } else {
        ?>
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        <?php
    }
    ?>
    <header>
   
    </header>
    <main>
        <div class="container">
            <?php
                if($resultadoSilenciadoOculto[0]=="S") {
                    ?>
                    <div class="row">
                        <div class="col s12 center-align">
                            <p id="chatSilenciado"><i class="material-icons">speaker_notes_off</i>chat silenciado</p>
                        </div>
                    </div>
                    <?php
                } else {
                    require "php/conexion.php";
                    $resultadoChat=$conexion->query("SELECT usuario,fecha,mensaje,profesional,dni FROM mensajes");
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
                                if($fila["dni"]==$dniUsuario && $fila["profesional"]=="S") {
                                    ?>
                                    <div class='row'>
                                        <div class='contenedorEnviado'>
                                            <div class='datosEnviado'>
                                                <span><?php echo $fila["usuario"]; ?><img class="profesionalStick" src="img/profesionalStick.png"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $fila["fecha"]; ?></span>
                                            </div>
                                            <div class='mensajeEnviado'><?php echo base64_decode($fila["mensaje"]); ?></div>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    if($fila["profesional"]=="S") {
                                        ?>
                                        <div class='row'>
                                            <div class='contenedorRecibido'>
                                                <div class='datosRecibido'>
                                                    <span><?php echo $fila["usuario"]; ?><img class="profesionalStick" src="img/profesionalStick.png"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $fila["fecha"]; ?></span>
                                                </div>
                                                <div class='mensajeRecibido'><?php echo base64_decode($fila["mensaje"]); ?></div>
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
                            }
                        } else {
                            while($fila=$resultadoChat->fetch_assoc()) {
                                if($fila["usuario"]==$nombreUsuario && $fila["profesional"]=="N") {
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
                                    if($fila["profesional"]=="S") {
                                        ?>
                                        <div class='row'>
                                            <div class='contenedorRecibido'>
                                                <div class='datosRecibido'>
                                                    <span><?php echo $fila["usuario"]; ?><img class="profesionalStick" src="img/profesionalStick.png"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $fila["fecha"]; ?></span>
                                                </div>
                                                <div class='mensajeRecibido'><?php echo base64_decode($fila["mensaje"]); ?></div>
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
                            }
                        }
                    }
                    $conexion->close();
                }
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
    <?php require "php/salir.php"; ?>
</body>
</html>