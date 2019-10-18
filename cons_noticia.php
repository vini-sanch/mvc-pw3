<?php
session_start();
include_once('controller/Noticia_controller.php');
include_once('controller/Categoria_controller.php');
include_once('controller/Usuario_controller.php');

$auth = autenticar();
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
							<th colspan="8">
								<h2>Categorias Cadastradas</h2>
							</th>
						</tr>
						<tr>
							<th scope="col">
								<h5>Código</h5>
							</th>
							<th scope="col">
								<h5>Título</h5>
							</th>
							<th scope="col">
								<h5>Autor</h5>
							</th>
							<th scope="col">
								<h5>Data</h5>
							</th>
							<th scope="col">
								<h5>Categoria</h5>
							</th>
							<th scope="col">
								<h5>Conteúdo</h5>
							</th>
							<th scope="col">
								<h5>Imagem</h5>
							</th>
							<?php if ($auth) : ?>
								<th scope="col">
									<h5>Ação</h5>
								</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($noticia->consultar() as $value) : ?>
							<tr>
								<td><?php echo $value->__get('cod_noticia'); ?></td>
								<td><?php echo $value->__get('titulo'); ?></td>
								<td><?php echo $value->__get('autor'); ?></td>
								<td>
									<?php
										$data = explode('-', $value->__get('data'));
										echo implode('/', array_reverse($data));
										?>
								</td>
								<td>
									<?php
										$cat = $categoria->consultar([$value->__get('cod_categoria')]);
										echo $cat[0]->__get('nome_categoria');
										?>
								</td>
								<td><?php echo $value->__get('conteudo'); ?></td>
								<td><img style="max-width:70px;" src="imagens/<?php echo $value->__get('imagem'); ?>" /></td>
								<?php if ($auth) : ?>
									<td>
										<a class='btn btn-outline-danger' onclick="confirma()" href="?codnoticia=<?php echo $value->__get('cod_noticia'); ?>&acao=excluir_not">Excluir</a>
										<a class='btn btn-outline-warning' href="atu_noticia.php?codnoticia=<?php echo $value->__get('cod_noticia'); ?>&acao=dados_not">Editar</a>
									</td>
								<?php endif; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<!-- <?php foreach ($noticia->consultar() as $valor) : ?>
				<div class="col-md-3">
					<div class="card" style="width: 18rem;">
						<div class="card-header">
							<h5 class="card-title"><?php echo $valor->__get('titulo'); ?></h5>
							<h5 class="card-title">
								<?php
									$cat = $categoria->consultar([$valor->__get('cod_categoria')]);
									echo 'Categoria: ' . $cat[0]->__get('nome_categoria');
									?>
							</h5>
						</div>
						<div class="card-body">
							<p class="card-text">Autor: <?php echo $valor->__get('autor'); ?></p>
							<p class="card-text">Data: <?php echo $valor->__get('data'); ?></p>
							<p class="card-text">Imagem: <?php echo $valor->__get('imagem'); ?></p>
							<p class="card-text"><?php echo $valor->__get('conteudo'); ?></p>
							<br/>
							<?php if ($auth) : ?>
								<a class='btn btn-danger' onclick="confirma()" >Excluir</a>
								<a class='btn btn-warning' >Editar</a>
							<?php endif; ?>
						</div>
					</div>
					<br/><br/>
				</div>
			<?php endforeach; ?> -->
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
