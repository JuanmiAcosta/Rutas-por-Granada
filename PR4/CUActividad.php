<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include "modelo/bd.php";
    include "modelo/bdActividades.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rol = $_POST['rol'];
        $metodo = $_POST['metodo'];

        if ($rol == null || $rol == "REGISTRADO"){
            echo $twig->render('modificarCrearActividad.html', ['error' => 'Su rol no le permite eso']);   
        }

        if ($metodo == "crear"){

            $titulo = $_POST['titulo'];
            $ubicacion = $_POST['ubicacion'];
            $ubicacion_url = $_POST['ubicacion_url'];
            $dificultad = $_POST['dificultad'];
            $epoca = $_POST['epoca'];
            $desnivel = $_POST['desnivel'];
            $distancia = $_POST['distancia'];
            $duracion = $_POST['duracion'];
            $descripcion = $_POST['descripcion'];
            $facebook = $_POST['facebook'];
            $twitter = $_POST['twitter'];
            $bonus1 = $_POST['bonus1'];
            $bonus2 = $_POST['bonus2'];
            $url_iframe = $_POST['url_iframe'];

            if ($titulo == null || $ubicacion == null || $ubicacion_url == null || $dificultad == null 
            || $epoca == null || $desnivel == null || $distancia == null || $duracion == null || $descripcion == null 
            || $facebook == null || $twitter == null || $bonus1 == null 
            || $bonus2 == null || $url_iframe == null){
                echo $twig->render('modificarCrearActividad.html', ['error' => 'Faltan campos por rellenar']);  
            }

            if (isset($_FILES['foto_1'])) {
                $errors = array();
                $file_name = $_FILES['foto_1']['name'];
                $file_size = $_FILES['foto_1']['size'];
                $file_tmp = $_FILES['foto_1']['tmp_name'];
                $file_type = $_FILES['foto_1']['type'];
                $file_name_parts = explode('.', $file_name);
                $file_ext = strtolower(end($file_name_parts));
                
                $extensions = array("jpeg", "jpg", "png");
                
                if (!in_array($file_ext, $extensions)) {
                    echo $twig->render('modificarCrearActividad.html', ['error' => 'Extensión no permitida, elige una imagen JPEG o PNG.']);
                    exit();  
                }
                
                if ($file_size > 2097152) {
                    echo $twig->render('modificarCrearActividad.html', ['error' => 'Tamaño del fichero demasiado grande.']);
                    exit();  
                }
                
                // Move uploaded file
                $target_path = "icon/" . $file_name;
                if (!move_uploaded_file($file_tmp, $target_path)) {
                    echo $twig->render('modificarCrearActividad.html', ['error' => 'Error al subir el archivo.']);
                    exit();
                }
            
                $foto_1 = "../icon/" . $file_name;
            }

            if (isset($_FILES['foto_2'])) {
                $errors = array();
                $file_name = $_FILES['foto_2']['name'];
                $file_size = $_FILES['foto_2']['size'];
                $file_tmp = $_FILES['foto_2']['tmp_name'];
                $file_type = $_FILES['foto_2']['type'];
                $file_name_parts = explode('.', $file_name);
                $file_ext = strtolower(end($file_name_parts));
                
                $extensions = array("jpeg", "jpg", "png");
                
                if (!in_array($file_ext, $extensions)) {
                    echo $twig->render('modificarCrearActividad.html', ['error' => 'Extensión no permitida, elige una imagen JPEG o PNG.']);
                    exit();  
                }
                
                if ($file_size > 2097152) {
                    echo $twig->render('modificarCrearActividad.html', ['error' => 'Tamaño del fichero demasiado grande.']);
                    exit();  
                }
                
                // Move uploaded file
                $target_path = "icon/" . $file_name;
                if (!move_uploaded_file($file_tmp, $target_path)) {
                    echo $twig->render('modificarCrearActividad.html', ['error' => 'Error al subir el archivo.']);
                    exit();
                }
            
                $foto_2 = "../icon/" . $file_name;
            }


            $id_act = insertarActividad($titulo, $ubicacion, $ubicacion_url, $dificultad, $epoca, $desnivel, $distancia, $duracion, $descripcion, $foto_1, $foto_2);
            insertarFotos($id_act, $foto_1, $foto_2);
            insertarRedes($id_act, $facebook, $twitter);
            insertarBonus($id_act, $bonus1, $bonus2);
            insertarIframe($id_act, $url_iframe);

            header("Location: /actividad/" . $id_act);

            exit();
        }else if ($metodo == "modificar"){

            $id_act = $_POST['id'];
            $titulo = $_POST['titulo'];
            $ubicacion = $_POST['ubicacion'];
            $ubicacion_url = $_POST['ubicacion_url'];
            $dificultad = $_POST['dificultad'];
            $epoca = $_POST['epoca'];
            $desnivel = $_POST['desnivel'];
            $distancia = $_POST['distancia'];
            $duracion = $_POST['duracion'];
            $descripcion = $_POST['descripcion'];

            if ($titulo == null && $ubicacion == null && $ubicacion_url == null && $dificultad == null
            && $epoca == null && $desnivel == null && $distancia == null && $duracion == null 
            && $descripcion == null){
                header("Location: /actividad/" . $id_act);
                exit();
             }

            // Seleccionar los atributos que no sean null
            $atributos = array();
            if ($titulo != null){
                $atributos['titulo'] = $titulo;
            }
            if ($ubicacion != null){
                $atributos['ubicacion'] = $ubicacion;
            }
            if ($ubicacion_url != null){
                $atributos['url_ubicacion'] = $ubicacion_url;
            }
            if ($dificultad != null){
                $atributos['dificultad'] = $dificultad;
            }
            if ($epoca != null){
                $atributos['epoca'] = $epoca;
            }
            if ($desnivel != null){
                $atributos['desnivel'] = $desnivel;
            }
            if ($distancia != null){
                $atributos['distancia'] = $distancia;
            }
            if ($duracion != null){
                $atributos['duracion'] = $duracion;
            }
            if ($descripcion != null){
                $atributos['descripcion'] = $descripcion;
            }

            modificarActividad($id_act, $atributos);

            header("Location: /actividad/" . $id_act);
            exit();
        }
    
    }else{
        header("Location: /actividad/" . $id_act);
        exit();
    }
?>