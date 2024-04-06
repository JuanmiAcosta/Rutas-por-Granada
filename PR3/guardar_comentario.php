<?php
include "conexion.php";
$conexion = Database::getConexion();

// Verificamos si se están enviando los datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recogemos los datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comments'];
    $fecha = date("Y-m-d H:i:s");

    $id = $_POST['act'];

    $stmt = $conexion->prepare("INSERT INTO COMENTARIOS (id, nombre, email, comentario, fecha) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $id, $name, $email, $comment, $fecha);

    $stmt->execute();

    $stmt->close();

    $conexion->close();

    header("Location: actividad/$id");
}
?>