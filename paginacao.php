<?php
    include_once('controller/Noticia_controller.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exemplo Paginação</title>

      <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php
        define('QTD_PAG', 2);
        $not = $noticia->consultar();
        $total_paginas = ceil(count($not) / QTD_PAG);
        $inicio = isset($_GET['indice']) ? $_GET['indice'] * QTD_PAG : 0;

        foreach ($noticia->consultarLimit($inicio, QTD_PAG) as $valor) {
            echo "Título: " . $valor->__get('titulo') . " - Data: " . $valor->__get('data') . '<br/>';
        }

        echo "<br/>";
        echo "<nav aria-label='Navegação de página exemplo'><ul class='pagination'>";

        for($i = 1; $i <= $total_paginas; $i++) {
            echo "<li class='page-item'><a class='page-link' href='?indice=" . ($i - 1) . "'>$i</a></li>";
        }

        echo "</ul></nav>";
    ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>