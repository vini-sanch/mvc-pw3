<?php
  session_start();
  include_once('controller/Usuario_controller.php');

  $auth = autenticar();

  if(!$auth) {
	echo "<script>
		alert('Acesso Proibido!');
		window.location.href = 'index.php';
	</script>";
  }
?>

<!doctype html>
<html lang="en">

<head>
	<title>Consulta de Usuários</title>
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
								<h2>Usuários Cadastrados</h2>
							</th>
						</tr>
						<tr>
							<th scope="col">
								<h5>Nome</h5>
							</th>
							<th scope="col">
								<h5>E-mail</h5>
							</th>
							<th scope="col">
								<h5>Senha</h5>
							</th>
							<th scope="col">
								<h5>Nível de Acesso</h5>
							</th>
							<th scope='col'>
								<h5>Ação</h5>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($usuario->consultar() as $value) : ?>
						<tr>
							<td><?php echo $value->nome; ?></td>
							<td><?php echo $value->email; ?></td>
							<td><?php echo $value->senha; ?></td>
							<td>
								<?php
									echo ($value->nivel_acesso == 1) ? 'Administrador' : 'Usuário';
									?>
							</td>
							<td>
								<a class='btn btn-outline-danger' onclick="confirma()" href="?codusuario=<?php echo $value->__get('codusuario'); ?>&acao=excluir_usu">Excluir</a>
								<a class='btn btn-outline-warning' href="atu_usuario.php?codusuario=<?php echo $value->__get('codusuario'); ?>&acao=dados_usu">Editar</a>
							</td>
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
			return confirm("Deseja realmente excluir esse usuário?");
		}
	</script>
</body>

</html>
