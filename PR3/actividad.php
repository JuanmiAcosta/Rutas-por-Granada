<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include "bd.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    
    $idact = basename($_SERVER['REQUEST_URI']);

    $actividad = getActividad($idact);
    $comentarios = getComentarios($idact);
    $redes = getRedes($idact);
    $bonus = getBonus($idact);
    $fotos = getFotos($idact);
    $noticias = getNoticias();
   $mapa = getMapa($idact);

    echo $twig->render('actividad.html', ['actividad' => $actividad , 'act' => $idact, 
    'comentarios' => $comentarios, 'redes' => $redes, 'bonus' => $bonus, 'fotos' => $fotos,
    'noticias' => $noticias, 'mapa' => $mapa]);
?>
