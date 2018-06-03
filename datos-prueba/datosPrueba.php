<?php
    require "../php/conexion.php";
    $conexion->query("TRUNCATE TABLE mensajes");
    $conexion->query("TRUNCATE TABLE peticiones");
    $conexion->query("TRUNCATE TABLE profesionales");
    $conexion->query("TRUNCATE TABLE usuarios");

    $conexion->query("INSERT INTO profesionales (dni,nombre,apellidos,email,clave,fechaNacimiento,colegioPsico,imagen,conectado,privadaActiva,silenciado,oculto) VALUES
        ('MDcwNTI3NDktWQ==','Álvaro','Cabezas Campos','alvarocc97@prueba.com','9f9c3be32340660bcf56ac8282423a3cfe04b2c6','1990-01-01','Excelentísimo Colegio de Psicólogos de Extremadura','img/fondoUsuario.jpg','N','N','N','N'),
        ('MDcwNTI3NTAtRg==','Alberto','Cabezas Campos','albertocc01@prueba.com','912b5d9d443df7f3e18ea860b7c0f2abb4340f9d','2000-01-01','Col·legi Oficial de Psicologia de Catalunya','img/fondoUsuario.jpg','N','N','N','N')");

    $conexion->query("INSERT INTO usuarios (nombre,clave,imagen,conectado,privadaActiva,silenciado,oculto) VALUES
        ('Álvaro','9f9c3be32340660bcf56ac8282423a3cfe04b2c6','img/fondoUsuario.jpg','N','N','N','N'),
        ('Alicia','912b5d9d443df7f3e18ea860b7c0f2abb4340f9d','img/fondoUsuario.jpg','N','N','N','N'),
        ('Alejandro','9864d2d744bfc75c63b57e06c2dd84e2dbcddc99','img/fondoUsuario.jpg','N','N','N','N')");

    $imagenesPerfil=glob('../img/imagenes-perfil/*');

    foreach($imagenesPerfil as $imagen){
        if(is_file($imagen))
        unlink($imagen);
    }
    
    $conexion->close();

    echo "1";
?>