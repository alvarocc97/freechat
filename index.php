<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="jQuery/jquery-3.2.1.js"></script>
    <script src="jQuery/jquery-ui.js"></script>
    <link href="jQuery/jquery-ui.css" rel="stylesheet">
    <link href="jQuery/jquery-ui.theme.css" rel="stylesheet">
    <script src="js/index.js"></script>
    <link href="css/index.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#cd69d6">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">
    <title>FreeChat</title>
</head>
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
<body>
    <header>
        <div>
            <img src="img/logo.png" alt="FreeChat">
        </div>
        <div id="autenticacion">
            <form id="autenticacionForm" action="index.php" method="post">
                <div>
                    <input type="text" id="usuarioAut" name="usuarioAut" size="20" maxlength="50" placeholder="Usuario/DNI" required title="Ingresa aquí tu nombre de usuario o tu DNI si estás registrado/a como profesional">
                    <input type="password" id="claveAut" name="claveAut" size="20" maxlength="50" placeholder="Clave" required title="Ingresa aquí tu clave de usuario">
                </div>
                <input type="submit" id="entrarAut" name="entrarAut" value="Entrar">
            </form>
        </div>
    </header>
    <main>
        <section>
            <p id="superior">Rápido, simple, seguro</p>
            <p id="inferior">Sin datos personales, sin dejar constancia, siéntete segura</p>
        </section>
        <aside>
            <div>
                <p id="tituloReg">Regístrate</p>
                <p id="subtituloReg">Totalmente gratis, por supuesto</p>
            </div>
            <div id="registro">
                <form id="registroForm" action="index.php" method="post">
                    <input type="text" id="usuarioReg" name="usuarioReg" size="20" maxlength="50" placeholder="Usuario" required title="Introduce aquí el nombre de usuario que quieras tener">
                    <input type="password" id="claveReg" name="claveReg" size="20" maxlength="50" placeholder="Clave" required title="Introduce aquí la clave que quieras tener">
                    <input type="password" id="claveReg2" name="claveReg2" size="20" maxlength="50" placeholder="Vuelve a introducir la clave" required title="Repite la clave para comprobar que no te has equivocado">
                    <img src="php/captcha.php" alt="CAPTCHA">
                    <input type="hidden" id="cadenaCaptchaReg" name="cadenaCaptchaReg" value=<?php echo $cadena; ?>>
                    <input type="text" id="captchaReg" name="captchaReg" size="20" maxlength="12" placeholder="Introduce los caracteres que ves" required>
                    <input type="submit" id="terminadoReg" name="terminadoReg" value="Terminado">
                    <a href="registroProfesional.php">¿Quieres unirte como profesional?</a>
                </form>
            </div>
        </aside>
    </main>
    <footer>
        <p>Borraremos tus conversaciones de nuestras bases de datos en cuanto cierres la sesión, lo que tengas que decir es sólo cosa tuya</p>
        <p>Álvaro Cabezas Campos&nbsp;&nbsp;&nbsp;<span>©</span>2018</p>
    </footer>

    <?php
        if(isset($_POST["usuarioReg"])) {
            $usuarioReg=$_POST["usuarioReg"];
            $claveReg=$_POST["claveReg"];
            $claveReg2=$_POST["claveReg2"];
            $cadenaCaptchaReg=$_POST["cadenaCaptchaReg"];
            $captchaReg=$_POST["captchaReg"];

            if($cadenaCaptchaReg==$captchaReg) {
                if($claveReg==$claveReg2) {
                    if(preg_match("/^[0-9]{8}-[TRWAGMYFPDXBNJZSQVHLCKE]$/i",$usuarioReg)) {
                        ?>
                        <div id="dialogoDniNoPermitido" title="No se permiten DNIs">
                            <p>Lo sentimos, pero para proteger en todo lo posible tu privacidad no podemos permitir que uses tu DNI como nombre de usuario.</p>
                        </div>
                        <?php
                    } else {
                        require "php/conexion.php";
                        $sql="SELECT nombre FROM usuarios WHERE nombre='$usuarioReg'";
                        $resultado=$conexion->query($sql);
                        $resultadoFilas=$resultado->num_rows;
                        if($resultadoFilas==0) {
                            $semilla="fth34bP1Qx";
                            $claveHash=sha1(md5($semilla.$claveReg));
                            $sql="INSERT INTO usuarios (nombre,clave,imagen,conectado) VALUES ('$usuarioReg','$claveHash','img/fondoUsuario.jpg','N')";
                            $conexion->query($sql);
                            ?>
                            <div id="dialogoRegistroCorrecto" title="Bienvenida">
                                <p>Ya estás registrada como usuaria en nuestras bases de datos y nadie podrá registrarse con tu mismo nombre.
                                Para entrar, simplemente procede a autenticarte. Ah, y podrás borrar tu cuenta cuando quieras.</p>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div id="dialogoUsuarioExistente" title="Usuaria existente">
                                <p>Lo sentimos, pero ya existe una usuaria con el mismo nombre. Prueba a elegir otro diferente y sabrás si está disponible
                                cuando el borde del campo permanezca verde.</p>
                            </div>
                            <?php
                        }
                        $conexion->close();
                    }
                } else {
                    ?>
                    <div id="dialogoClavesDiferentes" title="Las claves no coinciden">
                        <p>Lo sentimos, las claves que has introducido no coinciden. Vuelve a ponerlas con cuidado y asegúrate de que son iguales.</p>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div id="dialogoCaptchaIncorrecto" title="Captcha incorrecto">
                    <p>Lo sentimos, los caracteres introducidos no coinciden con el captcha. Vuelve a intentarlo.</p>
                </div>
                <?php
            }
        }

        if(isset($_POST["usuarioAut"])) {
            $usuarioAut=$_POST["usuarioAut"];
            $claveAut=$_POST["claveAut"];

            $semilla="fth34bP1Qx";
            $claveHash=sha1(md5($semilla.$claveAut));

            if(preg_match("/^[0-9]{8}-[TRWAGMYFPDXBNJZSQVHLCKE]$/i",$usuarioAut)) {
                $dniCod=base64_encode($usuarioAut);
                require "php/conexion.php";
                $sql="SELECT dni FROM profesionales WHERE dni='$dniCod' AND clave='$claveHash'";
                $resultado=$conexion->query($sql);
                $resultadoFilas=$resultado->num_rows;
                if($resultadoFilas==0) {
                    $conexion->close();
                    ?>
                    <div id="datosIncorrectos" title="Datos incorrectos">
                        <p>El usuario o la contraseña son incorrectos. Revísalo y vuelve a intentarlo.</p>
                    </div>
                    <?php
                } else {
                    $conexion->query("UPDATE profesionales SET conectado='S' WHERE dni='$dniCod'");
                    $conexion->close();
                    $_SESSION["dniProfesional"]=$usuarioAut;
                    header("Location: principal.php");
                }
            } else {
                require "php/conexion.php";
                $sql="SELECT nombre FROM usuarios WHERE nombre='$usuarioAut' AND clave='$claveHash'";
                $resultado=$conexion->query($sql);
                $resultadoFilas=$resultado->num_rows;
                if($resultadoFilas==0) {
                    $conexion->close();
                    ?>
                    <div id="datosIncorrectos" title="Datos incorrectos">
                        <p>El usuario o la contraseña son incorrectos. Revísalo y vuelve a intentarlo.</p>
                    </div>
                    <?php
                } else {
                    $conexion->query("UPDATE usuarios SET conectado='S' WHERE nombre='$usuarioAut'");
                    $conexion->close();
                    $_SESSION["nombreUsuario"]=$usuarioAut;
                    unset($_SESSION["dniProfesional"]);
                    header("Location: principal.php");
                }
            }

            
        }
    ?>
</body>
</html>