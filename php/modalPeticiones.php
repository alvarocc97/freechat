<div id="modalPeticiones" class="modal bottom-sheet">
    <div class="modal-content">
        <h5>Estas son tus peticiones pendientes</h5>
        <ul class="collection">
            <?php
                require "conexion.php";
                $resultadoPrivada=$conexion->query("SELECT privadaActiva FROM profesionales WHERE dni='$dniUsuario'");
                $resultadoPrivada=$resultadoPrivada->fetch_all();

                while($resultadoNotificacionesFila=$resultadoNotificaciones->fetch_assoc()) {
                    $solicitante=$resultadoNotificacionesFila["solicitante"];
                    $fecha=$resultadoNotificacionesFila["fecha"];

                    $resultadoImagen=$conexion->query("SELECT imagen FROM usuarios WHERE nombre='$solicitante'");
                    $resultadoImagen=$resultadoImagen->fetch_row();

                    ?>
                    <li class="collection-item avatar">
                        <img src="<?php echo $resultadoImagen[0]; ?>" class="circle" alt="IMAGEN NO DISPONIBLE">
                        <span class="title"><?php echo $solicitante; ?></span>
                        <p><span class="italic">Fecha: </span><?php echo $fecha; ?></p>
                        <span class="secondary-content">
                            <?php
                                if($resultadoPrivada[0]=="N") {
                                    ?>
                                    <button class="btn-floating waves-effect waves-light green aceptarPeticion" title="Aceptar petición"><i class="material-icons">check</i></button>
                                    <?php
                                } else {
                                    ?>
                                    <button class="btn-floating waves-effect waves-light green aceptarPeticion" title="Ya tienes una conversación privada abierta" disabled><i class="material-icons">check</i></button>
                                    <?php
                                }
                            ?>
                            
                            <button class="btn-floating waves-effect waves-light red rechazarPeticion" title="Rechazar petición"><i class="material-icons">clear</i></button>
                        </span>
                    </li>
                    <?php
                }
                $conexion->close();
            ?>
        </ul>
    </div>
</div>