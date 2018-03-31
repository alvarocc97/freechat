<?php
    function calcularLetra($dni) {
        $numero=substr($dni,0,-2);
        $cadenaLetras="TRWAGMYFPDXBNJZSQVHLCKE";
        $resto=($numero%23);

        $resultado=substr($cadenaLetras,$resto,1);

        return $resultado;
    }
?>