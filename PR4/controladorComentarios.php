<?php 
include "modelo/bd.php";

// Verificamos si se están enviando los datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $rol = $_POST['rol'];

    if ($rol == "REGISTRADO"){
        header("Location: actividad/$id");
        exit();
    }

    $metodo = $_POST['metodo'];

    if ($metodo == "insertar"){
        // Recogemos los datos del formulario
        $nick = $_POST['nick'];
        $email = $_POST['email'];
        $comments = $_POST['comments'];
        $avatar = $_POST['avatar'];
        $fecha = date("Y-m-d H:i:s");

        $id = $_POST['act'];

        if ($nick == "" || $email == "" || $comments == "") { //CUALQUIER CONTROL SOBRE LO QUE SE MANDA A BD
            alert ("No se han rellenado todos los campos");
            header("Location: actividad/$id");
            exit();
        }

        guardarComentario($id, $nick, $email, $comments, $fecha, $avatar); // INSERT REAL
        header("Location: actividad/$id");
        exit();

    }else if ($metodo == "actualizar"){ //actualizar comentarios

        $comments = $_POST['comments'];
        $fecha = "Moderado el ".date("Y-m-d H:i:s");

        $id = $_POST['id'];
        $act = $_POST['act'];

        if ($comments == "") { //CUALQUIER CONTROL SOBRE LO QUE SE MANDA A BD
            header("Location: actividad/$act");
            exit();
        }

        actualizarComentario($id, $comments, $fecha); // UPDATE REAL
        header("Location: actividad/$act");
        exit();



    }else if ($metodo == "eliminar"){ //eliminamos

        $id = $_POST['id'];
        $act = $_POST['act'];

        eliminarComentario($id); // DELETE REAL
        header("Location: actividad/$act");
        exit();

    }

    
}
?>