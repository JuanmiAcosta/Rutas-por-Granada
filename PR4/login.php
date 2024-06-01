<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include "modelo/bd.php";
    include "modelo/bdUsuarios.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nick = $_POST['nick'];
        $contrasenia = $_POST['contrasenia'];

        $usuario = getUsuario($nick);

        if ($usuario != null && verificar_contrasenia($contrasenia, $usuario['contrasenia'])) {
            session_start();
            $_SESSION['nick'] = $nick;
            header("Location: home");
            exit();
        } else {
            echo $twig->render('registrar_login.html', ['error' => 'Usuario o contraseña incorrectos']);
        }
    } else {
        echo $twig->render('registrar_login.html');
    }
?>