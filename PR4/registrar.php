<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include "modelo/bd.php";
    include "modelo/bdUsuarios.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nick = $_POST['nick'];
        $contrasenia = $_POST['contrasenia'];
        $contrasenia2 = $_POST['contrasenia2'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $avatar = $_POST['avatar'];


        if ($contrasenia != $contrasenia2) {
            echo $twig->render('registrar_login.html', ['error' => 'Las contraseñas no coinciden']);
            exit();
        }

        $rol = getRol($nick,$contrasenia);  //Buscamos si tiene un rol especial

        $contrasenia = hash('sha256', $contrasenia); // Encriptamos la contraseña (sha512)

        $usuario = getUsuario($nick);

        if ($rol == null) {
            $rol = 'REGISTRADO';
        }

        if ($usuario == null) {
            $stmt = $conexion->prepare("INSERT INTO USUARIOS (nick, nombre, email, contrasenia, avatar, rol) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $nick, $nombre, $email, $contrasenia, $avatar, $rol); // "s" indica que $nick es un string

            $stmt->execute();

            $stmt->close();

            session_start();
            $_SESSION['nick'] = $nick;
            header("Location: index.php");
            exit();
        } else {
            echo $twig->render('registrar_login.html', ['error' => 'El usuario ya existe']);
        }
        
    } else {
        echo $twig->render('registrar_login.html');
    }
?>