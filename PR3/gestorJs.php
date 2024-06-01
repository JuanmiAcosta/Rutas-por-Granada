<?php
include "bd.php";

$funcion = $_POST['funcion'];

// Llama a la función
$resultado = $funcion();

// Devuelve el resultado como JSON
echo json_encode($resultado);
?>