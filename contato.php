<?php
include_once('controller/Contato_controller.php');
if (isset($_SESSION['captcha'])) {
	echo "<script>
            window.location.href = 'captcha.php';
        </script>";
}
?>

<!doctype html>
<html lang="en">

<head>
	<title>Title</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<style>
		body {
			padding: 5%;
		}

		.nav-item {
			margin: .5rem;
		}
	</style>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="background: #05041A;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link btn btn-outline-warning" href="pag_noticias.php">JORNAL</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="contato.php">Contato</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-outline-danger" href="login.php">Entrar</a>
					</li>
				</ul>
				<br />
				<br />
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 center">
				<div class="card bg-light center mb-3" style="max-width: 18rem;">
					<div class="card-header">
						<h3>Formulário de Contato</h3>
					</div>
					<div class="card-body">
						<form action="?acao=contatar" method="POST">
							<label for="id-nome">Nome:</label>
							<input class="form-control" type="text" name="nome" id="id-nome" required />
							<label for="id-email">E-mail para Contato:</label>
							<input class="form-control" type="email" name="email" id="id-email" required />
							<label for="id-tel">Telefone:</label>
							<input class="form-control" max="99999999999" type="number" name="tel" id="id-tel" />
							<label for="id-mensagem">Mensagem:</label>
							<textarea name="mensagem" id="id-mensagem" cols="30" rows="12" required></textarea>
							<input type="submit" class="btn btn-info" id="id-entrar" value="Entrar" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
