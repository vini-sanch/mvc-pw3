<?php
  session_start();
  include_once('controller/Categoria_controller.php');
  include_once('controller/Usuario_controller.php');

  $auth = autenticar();
?>

<!doctype html>
<html lang="en">

<head>
	<title>Consulta de Categoria</title>
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
			<div class="col-md-12">
				<table class="table table-striped" id='table-users' style="text-align:center;">
					<thead>
						<tr>
							<th colspan="5">
								<h2>Categorias Cadastradas</h2>
							</th>
						</tr>
						<tr>
							<th scope="col">
								<h5>Código</h5>
							</th>
							<th scope="col">
								<h5>Categoria</h5>
							</th>
							<?php if($auth): ?>
								<th scope="col">
									<h5>Ação</h5>
								</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($categoria->consultar() as $value) : ?>
						<tr>
							<td><?php echo $value->__get('cod_categoria'); ?></td>
							<td><?php echo $value->__get('nome_categoria'); ?></td>
							<?php if($auth): ?>
								<td>
									<a class='btn btn-outline-danger' onclick="confirma()" href="?codcategoria=<?php echo $value->__get('cod_categoria'); ?>&acao=excluir_cat">Excluir</a>
									<a class='btn btn-outline-warning' href="atu_categoria.php?codcategoria=<?php echo $value->__get('cod_categoria'); ?>&acao=dados_cat">Editar</a>
								</td>
							<?php endif; ?>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
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

	<script>
		function confirma() {
			return confirm("Deseja realmente excluir essa categoria?");
		}
	</script>
</body>

</html>
