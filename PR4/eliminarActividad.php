<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include "modelo/bd.php";
    include "modelo/bdUsuarios.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    
    $idact = basename($_SERVER['REQUEST_URI']);

    // si el id es un número
    if(is_numeric($idact)){
        eliminarActividad($idact);
    }

    $noticias = getNoticias();
    $actividades = getActividades();

    //sesiones y usuarios
    session_start();

    if(isset($_SESSION['nick'])){
        $usuario = getUsuario($_SESSION['nick']);
    }else{
        $usuario = null;
    }

    echo $twig->render('portada.html', ['actividades' => $actividades, 'noticias' => $noticias, 'usuario' => $usuario]);
?>