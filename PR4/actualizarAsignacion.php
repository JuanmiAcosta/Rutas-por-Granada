<?php
    /*
    CREATE TABLE ROLES (
        rol VARCHAR(100) PRIMARY KEY
    );

    INSERT INTO ROLES (rol) VALUES ('REGISTRADO');
    INSERT INTO ROLES (rol) VALUES ('MODERADOR');
    INSERT INTO ROLES (rol) VALUES ('GESTOR');
    INSERT INTO ROLES (rol) VALUES ('SUPERUSUARIO');

    CREATE TABLE USUARIOS (
        nick VARCHAR(100) PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        contrasenia VARCHAR(500) NOT NULL,
        avatar VARCHAR(100),
        rol VARCHAR(100) NOT NULL,
        FOREIGN KEY (rol) REFERENCES ROLES(rol)
    );

    INSERT INTO USUARIOS (nick, nombre, email, contrasenia, rol) VALUES ('juanmi', 'Juan Miguel Acosta Ortega', 'jmplayer1.5@gmail.com', '123', 'SUPERUSUARIO');

    CREATE TABLE ASIGNACION (
        nick VARCHAR(100),
        rol VARCHAR(100),
        FOREIGN KEY (rol) REFERENCES ROLES(rol),
        PRIMARY KEY (nick, rol)
    );

    INSERT INTO ASIGNACION (nick, rol) VALUES ('juanmi', 'SUPERUSUARIO');
    INSERT INTO ASIGNACION (nick, rol) VALUES ('jesus', 'MODERADOR');
    INSERT INTO ASIGNACION (nick, rol) VALUES ('floren', 'GESTOR');
    INSERT INTO ASIGNACION (nick, rol) VALUES ('david', 'REGISTRADO');
    */

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include "modelo/bd.php";
    include "modelo/bdUsuarios.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $noticias = getNoticias();
    $asignaciones = getAsignaciones();

    //sesiones y usuarios

    session_start();

    if(isset($_SESSION['nick'])){
        $usuario = getUsuario($_SESSION['nick']);
    }else{
        $usuario = null;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $metodo = $_POST['metodo'];

        if ($metodo == "actualizar") {

            $nick = $_POST['nick'];
            $rol = $_POST['rol'];
            $usuario_rol = $_POST['usuario_rol'];


            if ($usuario_rol != "SUPERUSUARIO") {
                echo $twig->render('editarRoles.html', ['error' => 'No tienes permisos para realizar esta acción', 'usuario' => $usuario, 'asignaciones' => $asignaciones, 'noticias' => $noticias]);
                exit();
            }


            $stmt = $conexion->prepare("UPDATE ASIGNACION SET rol = ? WHERE nick = ?");

            $stmt->bind_param("ss", $rol, $nick); // "s" indica que $nick es un string

            $stmt->execute();

            $stmt->close();

            header('Location: editarRoles.php');

            exit();

        }else{ //CREAR UNA ASIGNACIÓN

            $nick = $_POST['nick'];
            $rol = $_POST['rol'];
            $contrasenia = $_POST['contrasenia'];
            $contrasenia2 = $_POST['contrasenia2'];
            $usuario_rol = $_POST['usuario_rol'];

            if ($usuario_rol != "SUPERUSUARIO") {
                echo $twig->render('editarRoles.html', ['error' => 'No tienes permisos para realizar esta acción', 'usuario' => $usuario, 'asignaciones' => $asignaciones, 'noticias' => $noticias]);
                exit();
            }

            if ($contrasenia != $contrasenia2) {// mando error
                echo $twig->render('editarRoles.html', ['error' => 'Las contraseñas no coinciden', 'usuario' => $usuario, 'asignaciones' => $asignaciones, 'noticias' => $noticias]);
                exit();
            }

            $stmt = $conexion->prepare("INSERT INTO ASIGNACION (nick, rol, contrasenia) VALUES (?, ?, ?)");

            $stmt->bind_param("sss", $nick, $rol, $contrasenia); // "s" indica que $nick es un string

            $stmt->execute();

            $stmt->close();

            header('Location: editarRoles.php');

            exit();

        }
        
    } else {
        echo $twig->render('registrar_login.html');
    }
?>