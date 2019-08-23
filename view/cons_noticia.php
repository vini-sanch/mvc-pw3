<?php
include_once('../controller/Noticia_controller.php');
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
	<a href="../index.php" class="btn btn-outline-success">Voltar</a>
	<br /><br />
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<?php foreach ($noticia->consultar() as $valor) : ?>
				<div class="card" style="width: 18rem;">
					<div class="card-header">
						<h5 class="card-title"><?php echo $valor->__get('titulo'); ?></h5>
						<h5 class="card-title"><?php echo $valor->__get('cod_categoria'); ?></h5>
					</div>
					<div class="card-body">
						<p class="card-text"><?php echo $valor->__get('autor'); ?></p>
						<p class="card-text"><?php echo $valor->__get('data'); ?></p>
						<p class="card-text"><?php echo $valor->__get('imagem'); ?></p>
						<p class="card-text"><?php echo $valor->__get('conteudo'); ?></p>
					</div>
				</div>
				<br><br>
				<?php endforeach; ?>
				<!-- <table class="table table-striped" id='table-users' style="text-align:center;">
					<thead>
						<tr>
							<th colspan="5">
								<h2>Notícias</h2>
							</th>
						</tr>
						<tr>
							<th scope="col">
								<h5>Título</h5>
							</th>
							<th scope="col">
								<h5>Data</h5>
							</th>
							<th scope="col">
								<h5>Senha</h5>
							</th>
							<th scope="col">
								<h5>Nível de Acesso</h5>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($usuario->consultar() as $value) : ?>
						<tr>
							<td scope="row"><strong><?php echo $value->codusuario; ?></strong></td>
							<td><?php echo $value->nome; ?></td>
							<td><?php echo $value->email; ?></td>
							<td><?php echo $value->senha; ?></td>
							<td>
								<?php
									echo ($value->nivel_acesso == 1) ? 'Administrador' : 'Usuário';
									?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table> -->
			</div>
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
