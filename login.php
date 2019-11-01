<?php
include_once('controller/Usuario_controller.php');
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
            <a class="nav-link btn btn-outline-success" href="contato.php">Contato</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="login.php">Entrar</a>
          </li>
        </ul>
        <br />
        <br />
      </div>
    </div>
    <?php if (!isset($_GET['acao'])) : ?>
      <div class="row">
        <div class="col-12 center">
          <div class="card bg-light center mb-3" style="max-width: 18rem;">
            <div class="card-header">
              <h3>Login</h3>
            </div>
            <div class="card-body">
              <form action="?acao=logar_usu" method="POST">
                <label for="id-email">E-mail</label>
                <input class="form-control" type="email" name="email" id="id-email" required />
                <label for="id-senha">Senha</label>
                <input class="form-control" type="password" name="senha" id="id-senha" required />
                <a href="cad_usuario.php">Cadastrar Usuário</a>
                <br /><br />
                <a href="?acao=ask_email">Esqueceu a Senha?</a>
                <br /><br />
                <input type="submit" class="btn btn-info" id="id-entrar" value="Entrar" />
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php elseif ($_GET['acao'] == 'ask_email') : ?>
      <div class="row">
        <div class="col-12 center">
          <div class="card bg-light center mb-3" style="max-width: 18rem;">
            <div class="card-header">
              <h3>Login</h3>
            </div>
            <div class="card-body">
              <form action="?acao=enviar_email" method="POST">
                <label for="id-email">Digite o Seu E-mail Cadastrado: </label>
                <input class="form-control" type="email" name="email" id="id-email" required />
                <br />
                <input type="submit" class="btn btn-info" id="id-entrar" value="Enviar" />
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php elseif (isset($_GET['token']) && isset($_GET['user']) && $_GET['acao'] == 'form_pass') : ?>
      <div class="row">
        <div class="col-12 center">
          <div class="card bg-light center mb-3" style="max-width: 18rem;">
            <div class="card-header">
              <h3>Redefinição de Senha</h3>
            </div>
            <div class="card-body">
              <form action="?acao=reset_senha" onsubmit="return verificarSenha();" method="POST">
                <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>" />
                <input type="hidden" name="user" value="<?php echo $_GET['user']; ?>" />

                <label for="id-email">Digite a sua nova senha: </label>
                <input class="form-control" type="password" name="senha" id="id-senha" required />
                <br />
                <label for="id-email">Confirme: </label>
                <input class="form-control" type="password" name="confirmar" id="id-confirmar" required />
                <br />
                <input type="submit" class="btn btn-info" id="id-entrar" value="Enviar" />
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <script>
    function verificarSenha() {
      senha = document.getElementById('id-senha').value;
      confirmar = document.getElementById('id-confirmar').value;
      if (senha != confirmar) {
        alert('Verifique a confirmação da senha');
        return false;
      } else {
        return true;
      }
    }
  </script>
</body>

</html>
