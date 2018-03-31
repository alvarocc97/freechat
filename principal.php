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
    <?php session_start();
        $nombreUsuario=$_SESSION["nombreUsuario"];
        require "php/conexion.php";
        $resultadoImagen=$conexion->query("SELECT imagen FROM usuarios WHERE nombre='$nombreUsuario'");
        $filaImagen=$resultadoImagen->fetch_row();
        $imagenUsuario=$filaImagen[0];
        $conexion->close();
    ?>
    <title><?php echo $nombreUsuario; ?></title>
</head>
<body>
    <ul id="slide-out" class="side-nav fixed">
        <li><div class="user-view">
            <div class="background">
                <img src="img/fondoEncabezado.jpg">
            </div>
            <a href="#" id="imagenUsuario"><img class="circle" src="<?php echo $imagenUsuario; ?>"></a>
            <a href="#!name"><span class="white-text name"><?php echo $nombreUsuario; ?></span></a>
            <a href="#!email"><span class="white-text email">prueba@alvaro.com</span></a>
        </div></li>
        <li><div class="center-align" id="tituloConectados">Usuarios conectados</div></li>
        <?php
            require "php/conexion.php";
            $resultadoConectados=$conexion->query("SELECT nombre FROM usuarios WHERE conectado='S' AND nombre!='$nombreUsuario'");
            $resultadoConectadosFilas=$resultadoConectados->num_rows;
            if($resultadoConectadosFilas==0) {
                ?>
                <li><div class="center-align">No hay ningún usuario conectado</div></li>
                <?php
            } else {
                while($nombre=$resultadoConectados->fetch_row()) {
                    ?>
                    <li><div class="center-align"><?php echo $nombre[0]; ?></div></li>
                    <?php
                }
            }
            $conexion->close();
        ?>
        <button id="botonConfiguracion" class="waves-effect waves-light waves-purple btn-flat btn-large"><i class="material-icons">settings</i></button>
    </ul>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    <header>
   
    </header>
    <main>
        <div class="container">
            <?php
                require "php/conexion.php";
                $resultadoChat=$conexion->query("SELECT usuario,fecha,mensaje FROM mensajes");
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
                    while($fila=$resultadoChat->fetch_assoc()) {
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
                                        <span><?php echo $fila["usuario"]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $fila["fecha"]; ?></span>
                                    </div>
                                    <div class='mensajeRecibido'><?php echo base64_decode($fila["mensaje"]); ?></div>
                                </div>
                            </div>
                            <?php
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
    <?php require "php/salir.php"; ?>
</body>
</html>