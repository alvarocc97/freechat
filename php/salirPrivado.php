<div class="row">
    <div class="col s12 right-align" id="cont">
        <button class="btn-floating btn-large waves-effect waves-light push-s11" id="cerrarPrivado" title="Cerrar la conversación"><i class="material-icons">speaker_notes_off</i></button>
        <div class="tap-target" data-activates="cerrarPrivado">
            <div class="tap-target-content left-align">
            <h5>Este es un chat privado</h5>
            <p>Pulsa sobre este botón para cerrar la conversación inmediatamente</p>
            </div>
        </div>
    </div>
</div>
<style>
    #cont {
        position:fixed;
        bottom:4.2em;
        right:2em;
    }
    #cerrarPrivado {
        background-color:rgb(160, 43, 170);
    }
    .tap-target {
        background-color:rgb(215, 130, 255);
    }
    .tap-target-content {
        color:white;
    }

    .tap-target-origin {
        background-color:rgb(160, 43, 170);
    }

    .tap-target-origin:hover {
        background-color:rgb(160, 43, 170);
    }
</style>