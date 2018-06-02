<?php
    if(isset($_REQUEST["dniProf"])) {
        if($_REQUEST["claveProf"]!="") {
            if($_FILES["imagenProf"]["error"]!=4) {
                $nombreProf=$_REQUEST["nombreProf"];
                $apellidosProf=$_REQUEST["apellidosProf"];
                $claveProf=$_REQUEST["claveProf"];
                $clave2Prof=$_REQUEST["clave2Prof"];
                $fechaNacimientoProf=$_REQUEST["fechaNacimientoProf"];
                $colegioPsicoProf=$_REQUEST["colegioPsicoProf"];
                $imagenProf=$_FILES["imagenProf"];

                if($claveProf==$clave2Prof) {
                    $semilla="fth34bP1Qx";
                    $claveHash=sha1(md5($semilla.$claveProf));

                    $nombreImagen=$imagenProf["name"];
                    $infoImagen=pathinfo($nombreImagen);
                    $extensionImagen=$infoImagen["extension"];
                    $rutaImagen="img/imagenes-perfil/".$dniCod.".".$extensionImagen;
                    $dimensionesImagen=getimagesize($imagenProf["tmp_name"]);

                    require "conexion.php";
                    if($dimensionesImagen[0]==$dimensionesImagen[1]) {
                        $sql="UPDATE profesionales SET nombre='$nombreProf',apellidos='$apellidosProf',clave='$claveHash',fechaNacimiento='$fechaNacimientoProf',colegioPsico='$colegioPsicoProf',imagen='$rutaImagen' WHERE dni='$dniCod'";
                        $conexion->query($sql);
                        move_uploaded_file($imagenProf["tmp_name"],$rutaImagen);
                        $conexion->close();

                        ?>
                        <button data-target="dialogoProfesionalEditado1" class="btn modal-trigger" id="disparador1"></button>
                        <div id="dialogoProfesionalEditado1" class="modal">
                            <div class="modal-content">
                                <h4>Has editado tu perfil con éxito</h4>
                                <p>Tu perfil de profesional se ha editado con éxito.</p>
                            </div>
                            <div class="modal-footer">
                                <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                            </div>
                        </div>
                        <?php
                    } else {
                        $sql="UPDATE profesionales SET nombre='$nombreProf',apellidos='$apellidosProf',clave='$claveHash',fechaNacimiento='$fechaNacimientoProf',colegioPsico='$colegioPsicoProf' WHERE dni='$dniCod'";
                        $conexion->query($sql);
                        $conexion->close();

                        ?>
                        <button data-target="dialogoImagenIncorrecta1" class="btn modal-trigger" id="disparador2"></button>
                        <div id="dialogoImagenIncorrecta1" class="modal">
                            <div class="modal-content">
                                <h4>La imagen seleccionada es incorrecta</h4>
                                <p>La imagen de perfil no corresponde a las dimensiones exigidas de <b>1:1</b>, por favor seleccione una imagen cuadrada. <b>El resto de datos han sido editados con éxito</b></p>
                            </div>
                            <div class="modal-footer">
                                <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                            </div>
                        </div>
                        <?php
                    }    
                } else {
                    ?>
                    <button data-target="dialogoClavesIncorrectas1" class="btn modal-trigger" id="disparador3"></button>
                    <div id="dialogoClavesIncorrectas1" class="modal">
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
            } else {
                $nombreProf=$_REQUEST["nombreProf"];
                $apellidosProf=$_REQUEST["apellidosProf"];
                $claveProf=$_REQUEST["claveProf"];
                $clave2Prof=$_REQUEST["clave2Prof"];
                $fechaNacimientoProf=$_REQUEST["fechaNacimientoProf"];
                $colegioPsicoProf=$_REQUEST["colegioPsicoProf"];

                if($claveProf==$clave2Prof) {
                    $semilla="fth34bP1Qx";
                    $claveHash=sha1(md5($semilla.$claveProf));

                    require "conexion.php";
                    $sql="UPDATE profesionales SET nombre='$nombreProf',apellidos='$apellidosProf',clave='$claveHash',fechaNacimiento='$fechaNacimientoProf',colegioPsico='$colegioPsicoProf' WHERE dni='$dniCod'";
                    $conexion->query($sql);
                    $conexion->close();

                    ?>
                    <button data-target="dialogoProfesionalEditado2" class="btn modal-trigger" id="disparador4"></button>
                    <div id="dialogoProfesionalEditado2" class="modal">
                        <div class="modal-content">
                            <h4>Has editado tu perfil con éxito</h4>
                            <p>Tu perfil de profesional se ha editado con éxito.</p>
                        </div>
                        <div class="modal-footer">
                            <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <button data-target="dialogoClavesIncorrectas2" class="btn modal-trigger" id="disparador5"></button>
                    <div id="dialogoClavesIncorrectas2" class="modal">
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
        } else {
            if($_FILES["imagenProf"]["error"]!=4) {
                $nombreProf=$_REQUEST["nombreProf"];
                $apellidosProf=$_REQUEST["apellidosProf"];
                $fechaNacimientoProf=$_REQUEST["fechaNacimientoProf"];
                $colegioPsicoProf=$_REQUEST["colegioPsicoProf"];
                $imagenProf=$_FILES["imagenProf"];

                $nombreImagen=$imagenProf["name"];
                $infoImagen=pathinfo($nombreImagen);
                $extensionImagen=$infoImagen["extension"];
                $rutaImagen="img/imagenes-perfil/".$dniCod.".".$extensionImagen;
                $dimensionesImagen=getimagesize($imagenProf["tmp_name"]);

                require "conexion.php";
                if($dimensionesImagen[0]==$dimensionesImagen[1]) {
                    $sql="UPDATE profesionales SET nombre='$nombreProf',apellidos='$apellidosProf',fechaNacimiento='$fechaNacimientoProf',colegioPsico='$colegioPsicoProf',imagen='$rutaImagen' WHERE dni='$dniCod'";
                    $conexion->query($sql);
                    move_uploaded_file($imagenProf["tmp_name"],$rutaImagen);
                    $conexion->close();

                    ?>
                    <button data-target="dialogoProfesionalEditado3" class="btn modal-trigger" id="disparador6"></button>
                    <div id="dialogoProfesionalEditado3" class="modal">
                        <div class="modal-content">
                            <h4>Has editado tu perfil con éxito</h4>
                            <p>Tu perfil de profesional se ha editado con éxito.</p>
                        </div>
                        <div class="modal-footer">
                            <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                        </div>
                    </div>
                    <?php
                } else {
                    $sql="UPDATE profesionales SET nombre='$nombreProf',apellidos='$apellidosProf',fechaNacimiento='$fechaNacimientoProf',colegioPsico='$colegioPsicoProf' WHERE dni='$dniCod'";
                    $conexion->query($sql);
                    $conexion->close();

                    ?>
                    <button data-target="dialogoImagenIncorrecta2" class="btn modal-trigger" id="disparador7"></button>
                    <div id="dialogoImagenIncorrecta2" class="modal">
                        <div class="modal-content">
                            <h4>La imagen seleccionada es incorrecta</h4>
                            <p>La imagen de perfil no corresponde a las dimensiones exigidas de <b>1:1</b>, por favor seleccione una imagen cuadrada. <b>El resto de datos han sido editados con éxito</b></p>
                        </div>
                        <div class="modal-footer">
                            <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                        </div>
                    </div>
                    <?php
                }
            } else {
                $nombreProf=$_REQUEST["nombreProf"];
                $apellidosProf=$_REQUEST["apellidosProf"];
                $fechaNacimientoProf=$_REQUEST["fechaNacimientoProf"];
                $colegioPsicoProf=$_REQUEST["colegioPsicoProf"];

                require "conexion.php";
                $sql="UPDATE profesionales SET nombre='$nombreProf',apellidos='$apellidosProf',fechaNacimiento='$fechaNacimientoProf',colegioPsico='$colegioPsicoProf' WHERE dni='$dniCod'";
                $conexion->query($sql);
                $conexion->close();

                ?>
                <button data-target="dialogoProfesionalEditado4" class="btn modal-trigger" id="disparador8"></button>
                <div id="dialogoProfesionalEditado4" class="modal">
                    <div class="modal-content">
                        <h4>Has editado tu perfil con éxito</h4>
                        <p>Tu perfil de profesional se ha editado con éxito.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                    </div>
                </div>
                <?php
            }
        }

        ?>
        <script>
            $("#dialogoProfesionalEditado1,#dialogoImagenIncorrecta1,#dialogoClavesIncorrectas1,#dialogoProfesionalEditado2,#dialogoClavesIncorrectas2,#dialogoProfesionalEditado3,#dialogoImagenIncorrecta2,#dialogoProfesionalEditado4").modal();
            $("#disparador1,#disparador2,#disparador3,#disparador4,#disparador5,#disparador6,#disparador7,#disparador8").hide().click();
        </script>
        <?php
    }
?>