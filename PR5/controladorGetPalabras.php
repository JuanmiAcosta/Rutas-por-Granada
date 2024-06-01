<?php
include 'modelo/bd.php'; 

$resultado = getPalabras(); // Llama a la función directamente

echo json_encode($resultado);
?>