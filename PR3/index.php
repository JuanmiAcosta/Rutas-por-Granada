<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include "bd.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $actividades = getActividades();
    $noticias = getNoticias();

    echo $twig->render('portada.html', ['actividades' => $actividades, 'noticias' => $noticias]);
?>
