<?php
session_start();
include_once('controller/Noticia_controller.php');
include_once('controller/Categoria_controller.php');
include_once('controller/Usuario_controller.php');

if(!isset($_SESSION['cod_logado'])) {
  echo "<script>
			window.location.href = 'login.php';
		</script>";
}
?>
<!doctype html>
<html lang="en">

<head>
	<title>Consulta de Notícias</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<style>
		body {
			padding: 5%;
		}
	</style>
</head>

<body>
	<br>
	<a href="index.php" class="btn btn-outline-success">Voltar</a>
	<br /><br />
	<div class="container">
		<div class="row">
		<?php foreach ($noticia->consultar() as $valor) : ?>
			<div class="col-md-3">
				<div class="card" style="width: 18rem;">
					<div class="card-header">
						<h5 class="card-title"><?php echo $valor->__get('titulo'); ?></h5>
						<h5 class="card-title">
						<?php 
							$cat = $categoria->consultar([$valor->__get('cod_categoria')]);
							echo 'Categoria: ' . $cat[0]->__get('nome_categoria'); 
						?></h5>
					</div>
					<div class="card-body">
						<p class="card-text">Autor: <?php echo $valor->__get('autor'); ?></p>
						<p class="card-text">Data: <?php echo $valor->__get('data'); ?></p>
						<p class="card-text">Imagem: <?php echo $valor->__get('imagem'); ?></p>
						<p class="card-text"><?php echo $valor->__get('conteudo'); ?></p>
					</div>
				</div>
				<br><br>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#table-users').DataTable();
		});
	</script>
</body>

</html>
