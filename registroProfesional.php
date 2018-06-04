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
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#cd69d6">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">
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
    <header class="row white">
    <div class="col s12">
            <a id="flechaVolver" href="index.php" class="waves-effect waves-light waves-purple btn-flat"><i class="material-icons">arrow_back</i></a>
            <span id="regTitulo">Regístrate como profesional</span>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <form class="col s12 white" action="registroProfesional.php" method="post">
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">fingerprint</i>
                            <label for="dni">DNI</label>
                            <input type="text" id="dni" name="dni" maxlength="10" required>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">person</i>
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" maxlength="50" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">person_outline</i>
                            <label for="apellidos">Apellidos</label>
                            <input type="text" id="apellidos" name="apellidos" maxlength="250" required>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">email</i>
                            <label for="email">Correo electrónico</label>
                            <input type="email" id="email" name="email" maxlength="50" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">lock</i>
                            <label for="clave">Clave</label>
                            <input type="password" id="clave" name="clave" maxlength="50" required>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">enhanced_encryption</i>
                            <label for="clave2">Vuelva a introducir la clave</label>
                            <input type="password" id="clave2" name="clave2" maxlength="50" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">event</i>
                            <label for="fechaNacimiento">Fecha de nacimiento</label>
                            <input type="text" id="fechaNacimiento" name="fechaNacimiento" class="datepicker" required>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">school</i>
                            <label for="colegioPsico">Colegio de psicólogos</label>
                            <input type="text" id="colegioPsico" name="colegioPsico" maxlength="100" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6 center-align">
                            <img src="php/captcha.php" alt="CAPTCHA">
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">fiber_pin</i>
                            <label for="captcha">Repite los caracteres</label>
                            <input type="hidden" id="cadenaCaptcha" name="cadenaCaptcha" value=<?php echo $cadena; ?>>
                            <input type="text" id="captcha" name="captcha" size="20" maxlength="12" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 center-align">
                            <button class="btn waves-effect waves-light" type="submit" name="action">ACEPTAR
                                <i class="material-icons right">done</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

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
            if($clave==$clave2) {
                if($cadenaCaptcha==$captcha) {
                    if(preg_match("/^[0-9]{8}-[TRWAGMYFPDXBNJZSQVHLCKE]$/i",$dni)) {
                        require_once "php/validaciones.php";
                        if(calcularLetra($dni)==substr($dni,-1)) {
                            if(preg_match("/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,10})$/",$email)) {
                                require "php/conexion.php";
                                $dniCodificado=base64_encode($dni);
                                $sql="SELECT dni FROM profesionales WHERE dni='$dniCodificado'";
                                $resultado=$conexion->query($sql);
                                $resultadoFilas=$resultado->num_rows;
                                if($resultadoFilas==0) {
                                    $semilla="fth34bP1Qx";
                                    $claveHash=sha1(md5($semilla.$clave));
                                    $sql="INSERT INTO profesionales (dni,nombre,apellidos,email,clave,fechaNacimiento,colegioPsico,imagen,conectado,privadaActiva,silenciado,oculto) VALUES ('$dniCodificado','$nombre','$apellidos','$email','$claveHash','$fechaNacimiento','$colegioPsico','img/fondoUsuario.jpg','N','N','N','N')";
                                    $conexion->query($sql);
                                    $conexion->close();
                                    ?>
                                    <button data-target="dialogoProfesionalRegistrado" class="btn modal-trigger" id="disparador7"></button>
                                    <div id="dialogoProfesionalRegistrado" class="modal">
                                        <div class="modal-content">
                                            <h4>Te has registrado como profesional</h4>
                                            <p>Te has registrado correctamente como profesional. Cuando estés conectado/a, tras tu nombre aparecerá este símbolo que confirma que eres un/una profesional verificado/a: <img id="profesionalStick" src="img/profesionalStick.png"></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    $conexion->close();
                                    ?>
                                    <button data-target="dialogoProfesionalExistente" class="btn modal-trigger" id="disparador6"></button>
                                    <div id="dialogoProfesionalExistente" class="modal">
                                        <div class="modal-content">
                                            <h4>Ya estabas registrado/a como profesional</h4>
                                            <p>Ya existe en nuestras bases de datos un profesional con ese DNI. Por favor, inicie sesión o inténtelo de nuevo.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <button data-target="dialogoEmailIncorrecto" class="btn modal-trigger" id="disparador5"></button>
                                <div id="dialogoEmailIncorrecto" class="modal">
                                    <div class="modal-content">
                                        <h4>Formato de email incorrecto</h4>
                                        <p>El formato del email introducido no es válido. Por favor, usa el formato <b>nombre@subdominio.dominio</b>.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <button data-target="dialogoDNIIncorrecto" class="btn modal-trigger" id="disparador4"></button>
                            <div id="dialogoDNIIncorrecto" class="modal">
                                <div class="modal-content">
                                    <h4>DNI incorrecto</h4>
                                    <p>El DNI introducido no es correcto. Por favor, vuelve a intentarlo.</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <button data-target="dialogoFormatoDNIIncorrecto" class="btn modal-trigger" id="disparador3"></button>
                        <div id="dialogoFormatoDNIIncorrecto" class="modal">
                            <div class="modal-content">
                                <h4>Formato del DNI incorrecto</h4>
                                <p>El formato de DNI introducido no es válido. Por favor, usa el formato <b>00000000-A</b>.</p>
                            </div>
                            <div class="modal-footer">
                                <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <button data-target="dialogoCaptchaIncorrecto" class="btn modal-trigger" id="disparador2"></button>
                    <div id="dialogoCaptchaIncorrecto" class="modal">
                        <div class="modal-content">
                            <h4>Captcha incorrecto</h4>
                            <p>El captcha introducido es incorrecto. Por favor, vuelve a intentarlo.</p>
                        </div>
                        <div class="modal-footer">
                            <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <button data-target="dialogoClavesIncorrectas" class="btn modal-trigger" id="disparador1"></button>
                <div id="dialogoClavesIncorrectas" class="modal">
                    <div class="modal-content">
                        <h4>Las claves no coinciden</h4>
                        <p>Las claves introducidas no son iguales. Por favor, vuelve a intentarlo.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                    </div>
                </div>
                <?php
            }
        }
    ?>
</body>
</html>