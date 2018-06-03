<?php
    if(isset($_REQUEST["nombreUsuario"])) {
        if($_REQUEST["claveUsuario"]!="") {
            if($_FILES["imagenUsuario"]["error"]!=4) {
                $claveUsuario=$_REQUEST["claveUsuario"];
                $clave2Usuario=$_REQUEST["clave2Usuario"];
                $imagenUsuario=$_FILES["imagenUsuario"];

                if($claveUsuario==$clave2Usuario) {
                    $semilla="fth34bP1Qx";
                    $claveHash=sha1(md5($semilla.$claveUsuario));

                    $nombreImagen=$imagenUsuario["name"];
                    $infoImagen=pathinfo($nombreImagen);
                    $extensionImagen=$infoImagen["extension"];
                    $rutaImagen="img/imagenes-perfil/".$nombreUsuario.".".$extensionImagen;
                    $dimensionesImagen=getimagesize($imagenUsuario["tmp_name"]);

                    require "conexion.php";
                    if($dimensionesImagen[0]==$dimensionesImagen[1]) {
                        $sql="UPDATE usuarios SET clave='$claveHash',imagen='$rutaImagen' WHERE nombre='$nombreUsuario'";
                        $conexion->query($sql);
                        move_uploaded_file($imagenUsuario["tmp_name"],$rutaImagen);
                        $conexion->close();

                        ?>
                        <button data-target="dialogoUsuarioEditado1" class="btn modal-trigger" id="disparador1"></button>
                        <div id="dialogoUsuarioEditado1" class="modal">
                            <div class="modal-content">
                                <h4>Has editado tu perfil con éxito</h4>
                                <p>Tu perfil de usuario se ha editado con éxito.</p>
                            </div>
                            <div class="modal-footer">
                                <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                            </div>
                        </div>
                        <?php
                    } else {
                        $sql="UPDATE usuarios SET clave='$claveHash' WHERE nombre='$nombreUsuario'";
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
                $claveUsuario=$_REQUEST["claveUsuario"];
                $clave2Usuario=$_REQUEST["clave2Usuario"];

                if($claveUsuario==$clave2Usuario) {
                    $semilla="fth34bP1Qx";
                    $claveHash=sha1(md5($semilla.$claveUsuario));

                    require "conexion.php";
                    $sql="UPDATE usuarios SET clave='$claveHash' WHERE nombre='$nombreUsuario'";
                    $conexion->query($sql);
                    $conexion->close();

                    ?>
                    <button data-target="dialogoUsuarioEditado2" class="btn modal-trigger" id="disparador4"></button>
                    <div id="dialogoUsuarioEditado2" class="modal">
                        <div class="modal-content">
                            <h4>Has editado tu perfil con éxito</h4>
                            <p>Tu perfil de usuario se ha editado con éxito.</p>
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
            if($_FILES["imagenUsuario"]["error"]!=4) {
                $imagenUsuario=$_FILES["imagenUsuario"];

                $nombreImagen=$imagenUsuario["name"];
                $infoImagen=pathinfo($nombreImagen);
                $extensionImagen=$infoImagen["extension"];
                $rutaImagen="img/imagenes-perfil/".$nombreUsuario.".".$extensionImagen;
                $dimensionesImagen=getimagesize($imagenUsuario["tmp_name"]);

                require "conexion.php";
                if($dimensionesImagen[0]==$dimensionesImagen[1]) {
                    $sql="UPDATE usuarios SET imagen='$rutaImagen' WHERE nombre='$nombreUsuario'";
                    $conexion->query($sql);
                    move_uploaded_file($imagenUsuario["tmp_name"],$rutaImagen);
                    $conexion->close();

                    ?>
                    <button data-target="dialogoUsuarioEditado3" class="btn modal-trigger" id="disparador6"></button>
                    <div id="dialogoUsuarioEditado3" class="modal">
                        <div class="modal-content">
                            <h4>Has editado tu perfil con éxito</h4>
                            <p>Tu perfil de usuario se ha editado con éxito.</p>
                        </div>
                        <div class="modal-footer">
                            <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                        </div>
                    </div>
                    <?php
                } else {
                    $conexion->close();

                    ?>
                    <button data-target="dialogoImagenIncorrecta2" class="btn modal-trigger" id="disparador7"></button>
                    <div id="dialogoImagenIncorrecta2" class="modal">
                        <div class="modal-content">
                            <h4>La imagen seleccionada es incorrecta</h4>
                            <p>La imagen de perfil no corresponde a las dimensiones exigidas de <b>1:1</b>, por favor seleccione una imagen cuadrada.</p>
                        </div>
                        <div class="modal-footer">
                            <button class="modal-action modal-close waves-effect waves-dialogo btn-flat">CERRAR</button>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <button data-target="dialogoNadaEditado" class="btn modal-trigger" id="disparador8"></button>
                <div id="dialogoNadaEditado" class="modal">
                    <div class="modal-content">
                        <h4>No has introducido nada</h4>
                        <p>Por favor introduce algún dato para editar tu perfil de usuario.</p>
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
            $("#dialogoUsuarioEditado1,#dialogoImagenIncorrecta1,#dialogoClavesIncorrectas1,#dialogoUsuarioEditado2,#dialogoClavesIncorrectas2,#dialogoUsuarioEditado3,#dialogoImagenIncorrecta2,#dialogoNadaEditado").modal();
            $("#disparador1,#disparador2,#disparador3,#disparador4,#disparador5,#disparador6,#disparador7,#disparador8").hide().click();
        </script>
        <?php
    }
?>