<?php

    function getUsuario($nick) {

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("SELECT * FROM USUARIOS WHERE nick = ?");
        $stmt->bind_param("s", $nick); // "s" indica que $nick es un string

        $stmt->execute();

        $resultado = $stmt->get_result();

        $usuario = null;

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
        }

        $stmt->close();

        return $usuario;
    }

    function verificar_contrasenia($contrasenia, $contrasenia_usuario) {
        return hash('sha256', $contrasenia) ===  $contrasenia_usuario; // Desencriptamos la contraseña (sha512)
    }

    function getRol($nick, $contrasenia) {
            
        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("SELECT rol FROM ASIGNACION WHERE nick = ? AND contrasenia = ?");
        $stmt->bind_param("ss", $nick, $contrasenia); // "s" indica que $nick es un string

        $stmt->execute();

        $resultado = $stmt->get_result();

        $rol = null;

        if ($resultado->num_rows > 0) {
            $rol = $resultado->fetch_assoc()['rol'];
        }

        $stmt->close();

        return $rol;
    }

    function getAsignaciones(){
        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("SELECT * FROM ASIGNACION");

        $stmt->execute();

        $resultado = $stmt->get_result();

        $asignaciones = array();   

        if ($resultado->num_rows > 0) {
            while($asignacion = $resultado->fetch_assoc()) {
                $asignaciones[] = array('nick' => $asignacion['nick'], 'rol' => $asignacion['rol']);
            }
        }

        $stmt->close();

        return $asignaciones;
    }

?>