<?php
    include_once('controller/Usuario_controller.php');
    $admin = true;

    session_start();
    if (!isset($_SESSION['cod_logado'])) {
        $admin = false;
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
            background: #05041A;
        }
    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <br>
    <a href="index.php" class="btn btn-outline-success">Voltar</a>
    <br /><br />
    <div class="container">
        <form method="POST" onsubmit="return verificarSenha();" action="?acao=cadastrar_usu">
            <fieldset>
                <legend>Formulário de Usuário</legend>
                <div class="form-group row">
                    <div class="col-sm-4-12">
                        <label for="id-nome" class="col-sm-1-12 col-form-label">Nome:</label><br />
                        <input type="text" maxlength="50" class="form-control" name="nome" id="id-nome" required placeholder="Exemplo: Harry Potter" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4-12">
                        <label for="id-email" class="col-sm-1-12 col-form-label">E-mail:</label><br />
                        <input type="email" maxlength="50" class="form-control" name="email" id="id-email" required placeholder="Exemplo: harrypotter@hogwarts.com" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4-12">
                        <label for="id-senha" class="col-sm-1-12 col-form-label">Senha:</label><br />
                        <input type="password" required maxlength="50" class="form-control" name="senha" id="id-senha" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4-12">
                        <label for="id-confirmar" class="col-sm-1-12 col-form-label">Confirme a Senha:</label><br />
                        <input type="password" required maxlength="50" class="form-control" name="senha" id="id-confirmar" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4-12">
                        <?php if($admin): ?>
                            <label for="id-nivel" class="col-sm-1-12 col-form-label">Nível de Acesso:</label><br />
                            <select name="nivel_acesso" required class="col-sm-1-12 form-control" id="id-nivel">
                                <option value="1">Administrador</option>
                                <option value="2">Usuário</option>
                            </select>
                        <?php else: ?>
                            <input type="hidden" name="nivel_acesso" value="2" />
                        <?php endif; ?>
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
    <script>
        function verificarSenha() {
            senha = document.getElementById('id-senha').value;
            confirmar = document.getElementById('id-confirmar').value;
            if(senha != confirmar) {
                alert('Verifique a confirmação da senha');
                return false;
            }
            else {
                return true;
            }
        }
    </script>
</body>

</html>
