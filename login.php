<?php
  include_once('controller/Usuario_controller.php');
  if(isset($_SESSION['captcha'])){
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
  </style>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="background: #05041A;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 center">
          <div class="card bg-light center mb-3" style="max-width: 18rem;">
            <div class="card-header"><h3>Login</h3></div>
            <div class="card-body">
              <form action="?acao=logar_usu" method="POST">
                <label for="id-email">E-mail</label>
                <input class="form-control" type="email" name="email" id="id-email" required />
                <label for="id-senha">Senha</label>
                <input class="form-control" type="password" name="senha" id="id-senha" required />
                <a href="cad_usuario.php">Cadastrar Usuário</a>
                <br/><br/>
                <input type="submit" class="btn btn-info" id="id-entrar" value="Entrar" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>
