<?php
    function insertarActividad($titulo, $ubicacion, $ubicacion_url, $dificultad, $epoca, $desnivel, $distancia, $duracion, $descripcion, $foto_1, $foto_2){
        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $sql = "INSERT INTO ACTIVIDADES (titulo, ubicacion, url_ubicacion, dificultad, epoca, desnivel, distancia, duracion, descripcion, foto_1, foto_2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssssssdssss", $titulo, $ubicacion, $ubicacion_url, $dificultad, $epoca, $desnivel, $distancia, $duracion, $descripcion, $foto_1, $foto_2); 
        $stmt->execute();
        $id = $conexion->insert_id; // Cojo el id de la actividad que acabo de insertar
        $stmt->close();
        return $id;
    }

    function insertarFotos($id_act, $foto_1, $foto_2){
        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $sql = "INSERT INTO FOTOS (id, img) VALUES (?, ?), (?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("isis", $id_act, $foto_1, $id_act, $foto_2); 
        $stmt->execute();
        $stmt->close();
    }

    function insertarRedes($id_act, $facebook, $twitter){
        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $sql = "INSERT INTO REDES (id, facebook, twitter) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("iss", $id_act, $facebook, $twitter); 
        $stmt->execute();
        $stmt->close();
    }

    function insertarBonus($id_act, $bonus1, $bonus2){
        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        //Map clave valor si bonus_1 = ../icon/perro.png -> desc_bonus = Se admiten mascotas ...

        if ($bonus1 == "../icon/perro.png") {
            $desc_bonus1 = "Se admiten mascotas en la actividad";
        } else if ($bonus1 == "../icon/agua.png") {
            $desc_bonus1 = "Aparcamiento disponible";
        } else if ($bonus1 == "../icon/agua.png") {
            $desc_bonus1 = "Ruta refrescante";
        } else if ($bonus1 == "../icon/nieve.png") {
            $desc_bonus1 = "Ruta con nieve en temporada";
        }

        if ($bonus2 == "../icon/perro.png") {
            $desc_bonus2 = "Se admiten mascotas en la actividad";
        } else if ($bonus2 == "../icon/agua.png") {
            $desc_bonus2 = "Aparcamiento disponible";
        } else if ($bonus2 == "../icon/agua.png") {
            $desc_bonus2 = "Ruta refrescante";
        } else if ($bonus2 == "../icon/nieve.png") {
            $desc_bonus2 = "Ruta con nieve en temporada";
        }
        

        $sql = "INSERT INTO BONUS (id, img_bonus, desc_bonus) VALUES (?, ?, ?), (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ississ", $id_act, $bonus1, $desc_bonus1, $id_act, $bonus2, $desc_bonus2); 
        $stmt->execute();
        $stmt->close();
    }

    function insertarIframe($id_act, $url_iframe){
        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $sql = "INSERT INTO CLAVE_MAPAS (id, clave) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("is", $id_act, $url_iframe); 
        $stmt->execute();
        $stmt->close();
    }

    function modificarActividad ($id_act , $atributos){
        global $conexion;

        if ($conexion->connect_error) {
            $conexion->close();
            $conexion = Database::getConexion();
        }

        $sql = "UPDATE ACTIVIDADES SET ";
        $i = 0;
        foreach ($atributos as $key => $value){
            if ($i == 0){
                $sql = $sql . $key . " = '" . $value . "'";
            }else{
                $sql = $sql . ", " . $key . " = '" . $value . "'";
            }
            $i++;
        }
        $sql = $sql . " WHERE id = " . $id_act;
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $stmt->close();
    }
?>