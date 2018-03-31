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
    <script src="js/registroProfesional.js"></script>
    <link href="css/registroProfesional.css" rel="stylesheet">
    <title>Regístrate como profesional</title>
</head>
<body>
    <?php
        session_start();

        $cadena="";
        $longitud=rand(8,12);
        $caracteres=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9");
        for($i=0;$i<$longitud;$i++) {
            $caracter=$caracteres[rand(0,count($caracteres)-1)];
            $cadena.=$caracter;
        }

        $_SESSION["cadenaCaptcha"]=$cadena;
    ?>
    <div class="container">
        <div class="row">
            <h1 class="col s12 center-align">Regístrate como profesional</h1>
        </div>
        <div class="row" id="filaForm">
            <form class="col s12 m6 push-m3" action="registroProfesional.php" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <label for="dni">DNI</label>
                        <input type="text" id="dni" name="dni" maxlength="10" required>
                    </div>
                    <div class="input-field col s12">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" maxlength="50" required>
                    </div>
                    <div class="input-field col s12">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" id="apellidos" name="apellidos" maxlength="250" required>
                    </div>
                    <div class="input-field col s12">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" maxlength="50" required>
                    </div>
                    <div class="input-field col s12">
                        <label for="clave">Clave</label>
                        <input type="password" id="clave" name="clave" maxlength="50" required>
                    </div>
                    <div class="input-field col s12">
                        <label for="clave2">Vuelva a introducir la clave</label>
                        <input type="password" id="clave2" name="clave2" maxlength="50" required>
                    </div>
                    <div class="input-field col s12">
                        <label for="fechaNacimiento">Fecha de nacimiento</label>
                        <input type="text" id="fechaNacimiento" name="fechaNacimiento" class="datepicker" required>
                    </div>
                    <div class="input-field col s12">
                        <label for="colegioPsico">Colegio de psicólogos</label>
                        <input type="text" id="colegioPsico" name="colegioPsico" maxlength="100" required>
                    </div>
                    <div class="input-field col s12 center-align">
                        <img src="php/captcha.php" alt="CAPTCHA">
                    </div>
                    <div class="input-field col s12">
                        <label for="captcha">Introduzca los caracteres que ves</label>
                        <input type="hidden" id="cadenaCaptcha" name="cadenaCaptcha" value=<?php echo $cadena; ?>>
                        <input type="text" id="captcha" name="captcha" size="20" maxlength="12" required>
                    </div>
                    <div class="input-field col s12 center-align">
                    <button class="btn waves-effect waves-light" type="submit" name="action">ACEPTAR
                        <i class="material-icons right">done</i>
                    </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
        if(isset($_POST["dni"])) {
            $dni=$_POST["dni"];
            $nombre=$_POST["nombre"];
            $apellidos=$_POST["apellidos"];
            $email=$_POST["email"];
            $clave=$_POST["clave"];
            $clave2=$_POST["clave2"];
            $fechaNacimiento=$_POST["fechaNacimiento"];
            $colegioPsico=$_POST["colegioPsico"];
            $cadenaCaptcha=$_POST["cadenaCaptcha"];
            $captcha=$_POST["captcha"];

            
        }
    ?>
</body>
</html>