<?php
include_once('../controller/Noticia_controller.php');
include_once('../controller/Categoria_controller.php');
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
			background: #05041A;
		}
	</style>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
	<br>
	<a href="../index.php" class="btn btn-outline-success">Voltar</a>
	<br /><br />
	<div class="container">
		<form method="POST" action="?acao=cadastrar_noticia" enctype="multipart/form-data">
			<fieldset>
				<legend>Formulário de Notícia</legend>
				<div class="form-group row">
					<div class="col-sm-4-12">
						<label for="id-titulo" class="col-sm-1-12 col-form-label">Título:</label><br />
						<input type="text" maxlength="40" class="form-control" name="titulo" id="id-titulo" required />
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4-12">
						<label for="id-data" class="col-sm-1-12 col-form-label">Data:</label><br />
						<input type="date" class="form-control" name="data" id="id-data" required />
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4-12">
						<label for="id-autor" class="col-sm-1-12 col-form-label">Autor:</label><br />
						<input type="text" maxlength="50" class="form-control" name="autor" id="id-autor" required />
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4-12">
						<label for="id-imagem" class="col-sm-1-12 col-form-label">Imagem:</label><br />
						<input type="file" maxlength="60" accept="image/*" class="form-control" name="imagem" id="id-imagem" required />
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4-12">
						<label for="id-categoria" class="col-sm-1-12 col-form-label">Categoria:</label><br />
						<select name="categoria" required class="col-sm-1-12 form-control" id="id-categoria">
							<?php foreach ($categoria->consultar() as $cat_valor) : ?>
							<option value="<?php echo $cat_valor->__get('cod_categoria'); ?>">
								<?php echo $cat_valor->__get('nome_categoria'); ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4-12">
						<label for="id-conteudo" class="col-sm-1-12 col-form-label">Conteúdo:</label><br />
						<textarea name="conteudo" id="id-conteudo" cols="100" rows="10"></textarea>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<!-- <button type="submit" class="btn btn-primary">Cadastrar</button> -->
						<input type="submit" class="btn btn-primary" value="Cadastrar">
					</div>
				</div>
			</fieldset>
		</form>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
