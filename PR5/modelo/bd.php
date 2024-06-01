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
                    $actividades[] = array('id' => $actividad['id'], 'titulo' => $actividad['titulo'], 'foto' => $actividad['foto_1'], 'publicada' => $actividad['publicada']);
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
            'foto_2' => $actividad['foto_2'],
            'id' => $actividad['id'],
            'publicada' => $actividad['publicada']);

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
            $id = 0;
            $publicada = 0;

            $ret_act = array('titulo' => $titulo, 'ubicacion' => $ubicacion, 'dificultad' => $dificultad,
            'epoca' => $epoca, 'distancia' => $distancia, 'duracion' => $duracion, 'descripcion' => $descripcion, 'url_ubicacion' => $url_ubicacion,
            'desnivel' => $desnivel, 'foto_1' => $foto_1, 'foto_2' => $foto_2, 'id' => $id, 'publicada' => $publicada);
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
                // Colores (0-255)
                $red = rand(0,255);
                $green = rand(0,255);
                $blue = rand(0,255);
                $comentarios[] = array('nombre' => $comentario['nick'],'id_comentario' => $comentario['id_comentario'], 'email' => $comentario['email'], 
                'comentario' => $comentario['comentario'], 'fecha' => $comentario['fecha'], 'avatar' => $comentario['avatar']
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

    function guardarComentario ($id, $nick, $email, $comment, $fecha, $avatar) {

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $palabrasFeillas = getPalabras();

        foreach ($palabrasFeillas as $palabra) {
            if (strpos($comment, $palabra['palabra']) !== false) {
                //Cambiar palabra por asteriscos
                $comment = str_replace($palabra['palabra'], "*****", $comment);
            }
        }

        $stmt = $conexion->prepare("INSERT INTO COMENTARIOS (id, nick, email, comentario, fecha, avatar) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $id, $nick, $email, $comment, $fecha, $avatar);

        $stmt->execute();

        $stmt->close();
    }

    function actualizarComentario($id, $comment, $fecha) {

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("UPDATE COMENTARIOS SET comentario = ?, fecha = ? WHERE id_comentario = ?");
        $stmt->bind_param("ssi", $comment, $fecha, $id);

        $stmt->execute();

        $stmt->close();
    }

    function eliminarComentario($id) {

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $stmt = $conexion->prepare("DELETE FROM COMENTARIOS WHERE id_comentario = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        $stmt->close();
    }

    function getActividadesPorTitulo($texto){
        //Esta función buscará las actividades cuyo titulo contenga el texto que se le pasa
        //se devuelve foto_1, titulo, ubicacion e id

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $texto = "%".$texto."%";

        $stmt = $conexion->prepare("SELECT * FROM ACTIVIDADES WHERE titulo LIKE ?");

        $stmt->bind_param("s", $texto);

        $stmt->execute();

        $resultado = $stmt->get_result();

        $actividades = array();

        if ($resultado->num_rows > 0) {
            while($actividad = $resultado->fetch_assoc()) {
                $actividades[] = array('id' => $actividad['id'], 'titulo' => $actividad['titulo'], 'foto' => $actividad['foto_1'], 'ubicacion' => $actividad['ubicacion'], 'publicada' => $actividad['publicada']);
            }
        }

        $stmt->close();

        return $actividades;
    }

    function getPublicadasPorTitulo($texto){


        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $texto = "%".$texto."%";

        $stmt = $conexion->prepare("SELECT * FROM ACTIVIDADES WHERE titulo LIKE ? AND publicada = 1");

        $stmt->bind_param("s", $texto);

        $stmt->execute();

        $resultado = $stmt->get_result();

        $actividades = array();

        if ($resultado->num_rows > 0) {
            while($actividad = $resultado->fetch_assoc()) {
                $actividades[] = array('id' => $actividad['id'], 'titulo' => $actividad['titulo'], 'foto' => $actividad['foto_1'], 'ubicacion' => $actividad['ubicacion'], 'publicada' => $actividad['publicada']);
            }
        }

        $stmt->close();

        return $actividades;
    }

    function eliminarActividad($idact){
            
        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }
        
        //Primero borrar en tabla COMENTARIOS con id = idact

        $stmt = $conexion->prepare("DELETE FROM COMENTARIOS WHERE id = ?");
        $stmt->bind_param("i", $idact);
        $stmt->execute();
        $stmt->close();

        //Segundo REDES con id = idact

        $stmt = $conexion->prepare("DELETE FROM REDES WHERE id = ?");
        $stmt->bind_param("i", $idact);
        $stmt->execute();
        $stmt->close();

        //Tercero FOTOS con id = idact

        $stmt = $conexion->prepare("DELETE FROM FOTOS WHERE id = ?");
        $stmt->bind_param("i", $idact);
        $stmt->execute();
        $stmt->close();

        //Luego BONUS con id = idact

        $stmt = $conexion->prepare("DELETE FROM BONUS WHERE id = ?");
        $stmt->bind_param("i", $idact);
        $stmt->execute();
        $stmt->close();

        //Después CLAVE_MAPAS con id = idact

        $stmt = $conexion->prepare("DELETE FROM CLAVE_MAPAS WHERE id = ?");
        $stmt->bind_param("i", $idact);
        $stmt->execute();
        $stmt->close();

        //Por último ACTIVIDADES con id = idact

        $stmt = $conexion->prepare("DELETE FROM ACTIVIDADES WHERE id = ?");
        $stmt->bind_param("i", $idact);
        $stmt->execute();
        $stmt->close();
            
    }

    function getComentariosPorTexto($texto){
        //Esta función buscará los comentarios cuyo texto contenga el texto que se le pasa
        //se devuelve nombre, email, comentario, fecha, avatar, id_comentario, id

        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $texto = "%".$texto."%";

        $stmt = $conexion->prepare("SELECT * FROM COMENTARIOS WHERE comentario LIKE ?");

        $stmt->bind_param("s", $texto);

        $stmt->execute();

        $resultado = $stmt->get_result();

        $comentarios = array();

        if ($resultado->num_rows > 0) {
            while($comentario = $resultado->fetch_assoc()) {
                //Conseguir el titulo de la actividad de ese comentario
                $stmt2 = $conexion->prepare("SELECT titulo FROM ACTIVIDADES WHERE id = ?");
                $stmt2->bind_param("i", $comentario['id']);
                $stmt2->execute();
                $resultado2 = $stmt2->get_result();
                $actividad = $resultado2->fetch_assoc();
                $stmt2->close();

                // Colores (0-255)
                $red = rand(0,255);
                $green = rand(0,255);
                $blue = rand(0,255);
                $comentarios[] = array('nombre' => $comentario['nick'],'id_comentario' => $comentario['id_comentario'], 'email' => $comentario['email'], 
                'comentario' => $comentario['comentario'], 'fecha' => $comentario['fecha'], 'avatar' => $comentario['avatar']
                , 'red' => $red, 'green' => $green, 'blue' => $blue, 'id' => $comentario['id'], 'titulo' => $actividad['titulo']);
            }
        }

        $stmt->close();

        return $comentarios;
    }

?>