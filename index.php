<?php
session_start();
include_once('controller/Usuario_controller.php');

if (!isset($_SESSION['cod_logado'])) {
  echo "<script>
              window.location.href = 'pag_noticias.php';
		  </script>";
}

$acesso = $_SESSION['nivel_logado'];
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
  </style>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="background: #05041A;">
  <h1 style="color:white">Jornal</h1>
  <h3 style="color:white">Bem-vindo, <?php echo $_SESSION['nome_logado']; ?></h3>
  <br /><br />
  <?php if ($acesso == 1) : ?>
    <a href="cad_usuario.php" class="btn btn-outline-success">Cadastrar Usuário</a>
    <br /><br />
    <a href="cons_usuario.php" class="btn btn-outline-success">Consultar Usuário</a>
    <br /><br />
    <a href="cad_categoria.php" class="btn btn-outline-info">Cadastrar Categoria</a>
    <br /><br />
  <?php endif; ?>
  <a href="cons_categoria.php" class="btn btn-outline-info">Consultar Categoria</a>
  <br /><br />
  <?php if ($acesso == 1) : ?>
  <br /><br />
  <a href="cad_noticia.php" class="btn btn-outline-warning">Cadastrar Notícia</a>
  <br /><br />
  <?php endif; ?>
  <a href="cons_noticia.php" class="btn btn-outline-warning">Consultar Notícia</a>
  <br /><br />
  <a href="login.php?acao=sair" class="btn btn-outline-danger">Sair</a>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
