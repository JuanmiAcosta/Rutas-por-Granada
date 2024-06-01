<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include "modelo/bd.php";
    include "modelo/bdUsuarios.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    
    $idact = basename($_SERVER['REQUEST_URI']);

    if ($idact != "modificarCrearActividad"){ 
        $actividad = getActividad($idact);
        $comentarios = getComentarios($idact);
        $redes = getRedes($idact);
        $bonus = getBonus($idact);
        $fotos = getFotos($idact);
        $mapa = getMapa($idact);
    }else{
        $actividad = null;
        $comentarios = null;
        $redes = null;
        $bonus = null;
        $fotos = null;
        $mapa = null;
    }

    $noticias = getNoticias();

    //sesiones y usuarios
    session_start();

    if(isset($_SESSION['nick'])){
        $usuario = getUsuario($_SESSION['nick']);
    }else{
        $usuario = null;
    }

    echo $twig->render('modificarCrearActividad.html', ['actividad' => $actividad , 'act' => $idact, 
    'comentarios' => $comentarios, 'redes' => $redes, 'bonus' => $bonus, 'fotos' => $fotos,
    'noticias' => $noticias, 'mapa' => $mapa, 'usuario' => $usuario]);
?>