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
    <script src="js/configuracion.js"></script>
    <link href="css/configuracion.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#cd69d6">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">
    <title>Configuración</title>
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION["dniProfesional"]) && !isset($_SESSION["nombreUsuario"])) {
            header("Location: permisoDenegado.html");
        }
        
        if(isset($_SESSION["dniProfesional"])) {
            $dniCod=base64_encode($_SESSION["dniProfesional"]);
            require "php/editarProfesional.php";
            require "php/conexion.php";
            $resultadoProfesional=$conexion->query("SELECT dni,nombre,apellidos,email,clave,fechaNacimiento,colegioPsico,imagen FROM profesionales WHERE dni='$dniCod'");
            $resultadoProfesional=$resultadoProfesional->fetch_assoc();
        } else {
            $nombreUsuario=$_SESSION["nombreUsuario"];
            require "php/conexion.php";

            $resultadoUsuario=$conexion->query("SELECT nombre,clave,imagen FROM usuarios WHERE nombre='$nombreUsuario'");
            $resultadoUsuario=$resultadoUsuario->fetch_assoc();
        }
    ?>
    <header class="row white">
        <div class="col s12">
            <a id="flechaVolver" href="principal.php" class="waves-effect waves-light waves-purple btn-flat"><i class="material-icons">arrow_back</i></a>
            <span id="confTitulo">Configuración</span>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col s12 perfilCont white">
                    <img src="<?php echo $resultadoProfesional['imagen']; ?>" class="circle imgPerfil">
                    <div class="row formCont">
                        <form action="configuracion.php" method="post" enctype="multipart/form-data" class="col s12">
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">fingerprint</i>
                                    <label for="dniProf">DNI</label>
                                    <input type="text" id="dniProf" name="dniProf" value="<?php echo base64_decode($resultadoProfesional['dni']); ?>" readonly title="Tu DNI no puede ser editado por motivos de seguridad" required>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">person</i>
                                    <label for="nombreProf">Nombre</label>
                                    <input type="text" id="nombreProf" name="nombreProf" value="<?php echo $resultadoProfesional['nombre']; ?>" maxlength="50" title="Puedes editar aquí tu nombre" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">person_outline</i>
                                    <label for="apellidosProf">Apellidos</label>
                                    <input type="text" id="apellidosProf" name="apellidosProf" value="<?php echo $resultadoProfesional['apellidos']; ?>" maxlength="250" title="Puedes editar aquí tus apellidos" required>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">email</i>
                                    <label for="emailProf">Correo electrónico</label>
                                    <input type="text" id="emailProf" name="emailProf" value="<?php echo $resultadoProfesional['email']; ?>" readonly title="Tu correo electrónico no puede ser editado por motivos de seguridad" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">lock</i>
                                    <label for="claveProf">Contraseña</label>
                                    <input type="password" id="claveProf" name="claveProf" maxlength="50" title="Puedes editar aquí tu contraseña, si no rellenas este campo no se modificará">
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">enhanced_encryption</i>
                                    <label for="clave2Prof">Vuelve a introducir la contraseña</label>
                                    <input type="password" id="clave2Prof" name="clave2Prof" maxlength="50" title="Vuelve a intriducir tu contraseña" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">event</i>
                                    <label for="fechaNacimientoProf">Fecha de nacimiento</label>
                                    <input type="text" id="fechaNacimientoProf" name="fechaNacimientoProf" class="datepicker" value="<?php echo $resultadoProfesional['fechaNacimiento']; ?>" title="Puedes editar aquí tu fecha de nacimiento" required>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">school</i>
                                    <label for="colegioPsicoProf">Colegio de psicólogos</label>
                                    <input type="text" id="colegioPsicoProf" name="colegioPsicoProf" value="<?php echo $resultadoProfesional['colegioPsico']; ?>" title="Puedes editar aquí tu colegio de psicólogos" required>
                                </div>
                            </div>
                            <div class="row">
                                <fieldset class="col s12 m6 push-m3">
                                    <legend>Imagen de perfil</legend>
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Examinar</span>
                                            <input type="file" id="imagenProf" name="imagenProf" accept=".jpg, .jpeg, .png">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" placeholder="La imagen debe ser cuadrada (1:1)">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 push-m3">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Editar perfil
                                        <i class="material-icons right">edit</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row eliminarCuentaCont">
                        <div class="col s12 center-align">
                            <button class="waves-effect waves-teal btn-flat" id="eliminarCuenta">Eliminar cuenta</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 switchesCont">
                            <div class="row">
                                <div class="col s12 m6">
                                    <div class="switch">
                                        <label>
                                            <input type="checkbox" id="silenciarSwitch">
                                            <span class="lever"></span>
                                            Silenciar chat (no verás ningún mensaje entrante)
                                        </label>
                                    </div>
                                </div>
                                <div class="col s12 m6">
                                    <div class="switch">
                                        <label>
                                            <input type="checkbox" id="ocultarSwitch">
                                            <span class="lever"></span>
                                            Permanecer oculto (no aparecerás conectado para el resto de usuarios)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>