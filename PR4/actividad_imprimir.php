<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include "modelo/bd.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $idact = basename($_SERVER['REQUEST_URI']);
    
    $actividad = getActividad($idact);
    $redes = getRedes($idact);
    $fotos = getFotos($idact);
    $bonus = getBonus($idact);

    echo $twig->render('actividad_imprimir.html', ['actividad' => $actividad , 'act' => $idact, 'redes' => $redes, 'fotos' => $fotos, 'bonus' => $bonus]);
?>
