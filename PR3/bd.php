<?php

    include "conexion.php";

    $conexion = Database::getConexion();

    function getNoticias(){

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("SELECT * FROM NOTICIAS");
        $stmt->execute();

        $resultado = $stmt->get_result();

        $noticias = array();

        if ($resultado->num_rows > 0) {
            while($noticia = $resultado->fetch_assoc()) {
                $noticias[] = array('titulo' => $noticia['titulo'], 'descripcion' => $noticia['descripcion'], 'img' => $noticia['img']);
            }
        }

        $stmt->close();

        return $noticias;
    }

    function getActividades(){

            global $conexion;

            if ($conexion->connect_error) {
                $conexion->close();
                $conexion = Database::getConexion();
            }
    
            $stmt = $conexion->prepare("SELECT * FROM ACTIVIDADES");
            $stmt->execute();
    
            $resultado = $stmt->get_result();
    
            $actividades = array();
    
            if ($resultado->num_rows > 0) {
                while($actividad = $resultado->fetch_assoc()) {
                    $actividades[] = array('id' => $actividad['id'], 'titulo' => $actividad['titulo'], 'foto' => $actividad['foto_1']);
                }
            }
    
            $stmt->close();
    
            return $actividades;
    }

    function getActividad($idact) {

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("SELECT * FROM ACTIVIDADES WHERE id = ?");
        $stmt->bind_param("i", $idact); // "i" indica que $idact es un número entero

        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {

            $actividad = $resultado->fetch_assoc();

            // Valores a devolver
            $ret_act = array('titulo' => $actividad['titulo'],
            'ubicacion' => $actividad['ubicacion'],
            'url_ubicacion' => $actividad['url_ubicacion'],
            'dificultad' => $actividad['dificultad'], 
            'epoca' => $actividad['epoca'], 
            'desnivel' => $actividad['desnivel'], 
            'distancia' => $actividad['distancia'],
            'duracion' => $actividad['duracion'], 
            'descripcion' => $actividad['descripcion'],
            'foto_1' => $actividad['foto_1'],
            'foto_2' => $actividad['foto_2'],);

        }else{
            // Valores act_vacia
            $titulo = "<Titulo actividad>";
            $ubicacion = "<Ubicacion actividad>";
            $url_ubicacion = "<URL ubicacion>";
            $dificultad = "<Dificultad>";
            $epoca = "<Epoca>";
            $desnivel = "<Desnivel>";
            $distancia = "<Distancia>";
            $duracion = "<Duracion>";
            $descripcion = "<Descripcion>";
            $foto_1 = "../icon/placeholder.jpg";
            $foto_2 = "../icon/placeholder.jpg";

            $ret_act = array('titulo' => $titulo, 'ubicacion' => $ubicacion, 'dificultad' => $dificultad,
            'epoca' => $epoca, 'distancia' => $distancia, 'duracion' => $duracion, 'descripcion' => $descripcion, 'url_ubicacion' => $url_ubicacion,
            'desnivel' => $desnivel, 'foto_1' => $foto_1, 'foto_2' => $foto_2);
        }

        $stmt->close();

        return $ret_act;
    }

    function getBonus($idact) {

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("SELECT * FROM BONUS WHERE id = ?");
        $stmt->bind_param("i", $idact); // "i" indica que $idact es un número entero

        $stmt->execute();

        $resultado = $stmt->get_result();

        $bonus_ext = array(); //Será un array de arrays

        if ($resultado->num_rows > 0) {
            while($bonus = $resultado->fetch_assoc()) {
                $bonus_ext[] = array('img_bonus' => $bonus['img_bonus'], 'desc_bonus' => $bonus['desc_bonus'],);
            }
        }

        $stmt->close();

        return $bonus_ext;
    }

    function getRedes($idact) {

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("SELECT * FROM REDES WHERE id = ?");
        $stmt->bind_param("i", $idact); // "i" indica que $idact es un número entero

        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {

            $redes = $resultado->fetch_assoc();

            // Valores a devolver
            $ret_red = array('facebook' => $redes['facebook'],
            'twitter' => $redes['twitter']);

        }else{
            // Valores red_vacia
            $facebook = "#";
            $twitter = "#";

            $ret_red = array('facebook' => $facebook, 'twitter' => $twitter);
        }

        $stmt->close();

        return $ret_red;
    }

    function getComentarios($idact) {

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("SELECT * FROM COMENTARIOS WHERE id = ?");
        $stmt->bind_param("i", $idact); // "i" indica que $idact es un número entero

        $stmt->execute();

        $resultado = $stmt->get_result();

        $comentarios = array();   

        if ($resultado->num_rows > 0) {
            while($comentario = $resultado->fetch_assoc()) {
                //Avatar (1-5)
                $avatar = rand(1,5);
                // Colores (0-255)
                $red = rand(0,255);
                $green = rand(0,255);
                $blue = rand(0,255);
                $comentarios[] = array('nombre' => $comentario['nombre'], 'email' => $comentario['email'], 
                'comentario' => $comentario['comentario'], 'fecha' => $comentario['fecha'], 'avatar' => $avatar
                , 'red' => $red, 'green' => $green, 'blue' => $blue);
            }
        }

        $stmt->close();

        return $comentarios;
    }

    function getFotos($idact) {

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("SELECT * FROM FOTOS WHERE id = ?");
        $stmt->bind_param("i", $idact); // "i" indica que $idact es un número entero

        $stmt->execute();

        $resultado = $stmt->get_result();

        $fotos = array();   

        if ($resultado->num_rows > 0) {
            while($foto = $resultado->fetch_assoc()) {
                $fotos[] = array('img' => $foto['img']);
            }
        }

        $stmt->close();

        return $fotos;
    }

    function getPalabras() {

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("SELECT * FROM PALABRAS_PROHIBIDAS");
        $stmt->execute();

        $resultado = $stmt->get_result();

        $palabras = array();

        if ($resultado->num_rows > 0) {
            while($palabra = $resultado->fetch_assoc()) {
                $palabras[] = array('palabra' => $palabra['palabra']);
            }
        }

        $stmt->close();

        return $palabras;
    }

    function getMapa($idact) {

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("SELECT * FROM CLAVE_MAPAS WHERE id = ?");
        $stmt->bind_param("i", $idact); // "i" indica que $idact es un número entero

        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {

            $mapa = $resultado->fetch_assoc();

            // Valores a devolver
            $ret_mapa = array('clave' => $mapa['clave']);

        }else{
            // Valores mapa_vacio
            $clave = "<Clave de mapa>";

            $ret_mapa = array('clave' => $clave);
        }

        $stmt->close();

        return $ret_mapa;
    }

?>