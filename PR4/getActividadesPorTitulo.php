<?php
    include 'modelo/bd.php'; 

    $texto = $_POST['texto'];

    $resultado = getActividadesPorTitulo($texto); // Llama a la función directamente

    echo json_encode($resultado);
?>