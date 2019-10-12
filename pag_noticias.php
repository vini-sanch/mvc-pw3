<?php
    session_start();
	include_once('controller/Noticia_controller.php');
    include_once('controller/Categoria_controller.php');
?>
<!doctype html>
<html lang="en">

<head>
	<title>Consulta de Notícias</title>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />

    <style>
        body {
            padding: 1rem;
        }
        .card {
            margin: .5rem;
        }
    </style>
</head>

<body style="background: #05041A;">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">JORNAL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger" href="login.php">Entrar</a>
                    </li>
                </ul>
                <br/>
                <br/>
            </div>
        </div>

        <div class="row">            
            <div class="col-lg-2">
                <nav class="nav flex-column">
                    <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="pag_noticias.php"><strong>Início</strong></a>
                                <span class="badge badge-secondary"></span>
                            </li>
                        <?php foreach($categoria->consultar() as $cat): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="?acao=filtrar&codcategoria=<?php echo $cat->__get('cod_categoria'); ?>"><?php echo $cat->__get('nome_categoria'); ?></a>
                                <span class="badge badge-secondary"><?php echo $cat->num_noticias(); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>

            <div class="col-lg-10 container">
                <div class="row">
                    <?php foreach($noticias as $not): ?>
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="imagens/<?php echo $not->__get('imagem'); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $not->__get('titulo'); ?></h5>
                                    <p class="card-text">Autor: <?php echo $not->__get('autor'); ?></p>
                                    <p class="card-text">
                                        <?php 
                                            $data = explode('-', $not->__get('data'));
                                            echo implode('/', array_reverse($data)); 
                                        ?>
                                    </p>
                                    <p class="card-text">
                                        <a href="carregar_pag.php?cod_noticia=<?php echo $not->__get('cod_noticia'); ?>">Ver Mais</a>
                                    </p>
                                </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php
                        echo "<br/>";
                        echo "<nav aria-label='Navegação de página exemplo'><ul class='pagination'>";
                
                        for($i = 1; $i <= $total_paginas; $i++) {
                            echo "<li class='page-item'><a class='page-link' href='?indice=" . ($i - 1) . "'>$i</a></li>";
                        }
                
                        echo "</ul></nav>";
                ?>
            </div>
        </div>
    </div>
</body>

</html>
