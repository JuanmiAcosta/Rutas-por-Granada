<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include "modelo/bd.php";
    include "modelo/bdUsuarios.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $noticias = getNoticias();

    //sesiones y usuarios
    session_start();

    if(isset($_SESSION['nick'])){
        $usuario = getUsuario($_SESSION['nick']);
    }else{
        $usuario = null;
    }

    if ($usuario['rol'] == "SUPERUSUARIO" || $usuario['rol'] == "GESTOR" || $usuario['rol'] == "MODERADOR"){
        echo $twig->render('listadoActs.html', ['usuario' => $usuario, 'noticias' => $noticias]);
    }else{
        header('Location: index.php');
        exit();    
    }  
?>