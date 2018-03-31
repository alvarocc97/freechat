<?php
    // APLICACIÓN WEB PARA GESTIONAR UN SISTEMA VIRTUAL DE ALUMNOS CON BASE DE DATOS
    // \\\\ REALIZADO POR: ÁLVARO CABEZAS CAMPOS ////
    // SCRIPT QUE GENERA UNA IMAGEN CAPTCHA Y LA ENVÍA AL NAVEGADOR


    // MODIFICAMOS LA CABECERA PARA POSIBILITAR EL ENVÍO DE LA IMAGEN PNG
    header("Content-type: image/png");
    session_start();
    $cadena=$_SESSION["cadenaCaptcha"];
    
    // CREAMOS ALEATORIAMENTE LAS COORDENADAS DONDE APARECERÁ LA CADENA EN LA IMAGEN
    $x=rand(50,100);
    $y=rand(5,80);

    // ABRIMOS LA IMÁGEN Y LA ASIGNAMOS A UN MANEJADOR
    $imagenPNG=imagecreatefrompng("../img/fondoCaptcha.png");

    // CREAMOS EL COLOR PARA EL TEXTO Y LAS LÍNEAS
    $colorCadena=imagecolorallocate($imagenPNG,0,0,0);

    // AÑADIMOS EL TEXTO (MANEJADOR,TAMAÑO(1-5),COORDENADA X, COORDENADA Y, CONTENIDO, COLOR)
    imagestring($imagenPNG,5,$x,$y,$cadena,$colorCadena);

    // AÑADIMOS 10 LÍNEAS PARA ENSUCIAR EL CAPTCHA CON COORDENADAS ALEATORIAS
    for ($contador=1; $contador<=10; $contador++){
        $xOrigen=rand(0,249);
        $yOrigen=rand(0,99);
        $xFinal=rand(0,249);
        $yFinal=rand(0,99);
        imageline ($imagenPNG,$xOrigen,$yOrigen,$xFinal,$yFinal,$colorCadena);
    }

    // ENVIAMOS LA IMAGEN AL NAVEGADOR
    imagepng($imagenPNG);

    // LIBERAMOS RECURSOS
    imagedestroy($imagenPNG);
?>