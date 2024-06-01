<?php
    include 'modelo/bd.php'; 

    $texto = $_POST['texto'];

    $resultado = getComentariosPorTexto($texto); // Llama a la función directamente

    echo json_encode($resultado);
?>