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
    <title>Configuración</title>
</head>
<body>
    <?php
        session_start();
        $nombreUsuario=$_SESSION["nombreUsuario"];
        require "php/conexion.php";
        $resultadoImagen=$conexion->query("SELECT * FROM usuarios WHERE nombre='$nombreUsuario'");
        $fila=$resultadoImagen->fetch_row();
        $conexion->close();
    ?>
    <header>
        <div>
            <a id="flechaVolver" class="waves-effect waves-light waves-purple btn-flat"><i class="material-icons">arrow_back</i></a>
            <span id="confTitulo">Configuración</span>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field s12">
                            <label for="nombreUsuario">Usuario</label>
                            <input type="text" id="usuarioMod" name="usuarioMod" maxlength="50" value="<?php echo $fila[1]; ?>" required title="Introduce aquí tu nuevo nombre de usuario">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>