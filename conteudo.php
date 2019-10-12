<?php
	include_once('controller/Noticia_controller.php');
    $not = $noticia->consultar();
    $total_paginas = ceil(count($not) / QTD_PAG);
    $inicio = isset($_GET['indice']) ? $_GET['indice'] * QTD_PAG : 0;

    foreach ($noticia->consultarLimit($inicio, QTD_PAG) as $valor) {
        echo "Título: " . $valor->__get('titulo') . " - Data: " . $valor->__get('data') . '<br/>';
    }
?>