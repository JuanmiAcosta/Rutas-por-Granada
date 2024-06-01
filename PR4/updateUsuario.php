<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include "modelo/bd.php";
    include "modelo/bdUsuarios.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nick_actual = $_POST['nick_actual'];
        $contrasenia = $_POST['contrasenia'];
        $contrasenia2 = $_POST['contrasenia2'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $avatar = $_POST['avatar'];
        $avatar_actual = $_POST['avatar_actual'];


        if ($contrasenia != "" && $contrasenia2 != ""){ // QUeremos modificar la contraseña
            if ($contrasenia != $contrasenia2) {
                echo $twig->render('registrar_login.html', ['error' => 'Las contraseñas no coinciden']);
                exit();
            }

            $contrasenia = hash('sha256', $contrasenia); // Encriptamos la contraseña (sha512)

            $stmt = $conexion->prepare("UPDATE USUARIOS SET contrasenia = ? WHERE nick = ?");

            $stmt->bind_param("ss", $contrasenia, $nick_actual); // "s" indica que $nick es un string

            $stmt->execute();

            $stmt->close();

        }

        if ($nombre != "") {
            $stmt = $conexion->prepare("UPDATE USUARIOS SET nombre = ? WHERE nick = ?");

            $stmt->bind_param("ss", $nombre, $nick_actual); // "s" indica que $nick es un string

            $stmt->execute();

            $stmt->close();
        }

        if ($email != "") {
            $stmt = $conexion->prepare("UPDATE USUARIOS SET email = ? WHERE nick = ?");

            $stmt->bind_param("ss", $email, $nick_actual); // "s" indica que $nick es un string

            $stmt->execute();

            $stmt->close();
        }

        if ($avatar != $avatar_actual) {
            $stmt = $conexion->prepare("UPDATE USUARIOS SET avatar = ? WHERE nick = ?");

            $stmt->bind_param("ss", $avatar, $nick_actual); // "s" indica que $nick es un string

            $stmt->execute();

            $stmt->close();
        }

        session_start();
        $_SESSION['nick'] = $nick_actual;
        header("Location: index.php");
        exit();        
        
    } else {
        header("Location: index.php");
        exit(); 
    }
?>