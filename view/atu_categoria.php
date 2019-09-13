<?php
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
    <a href="cons_categoria.php" class="btn btn-outline-success">Voltar</a>
    <br /><br />
    <div class="container">
        <form method="POST" action="?acao=atualizar_cat">
            <fieldset>
                <legend>Atualizar Categoria</legend>
                <div class="form-group row">
                    <div class="col-sm-4-12">
                        <label for="id-categoria" class="col-sm-1-12 col-form-label">Código da Categoria:</label><br />
                        <input type="text" class="form-control" name="codcategoria" id="id-categoria" value="<?php echo $categoria->__get('cod_categoria'); ?>"  required readonly />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4-12">
                        <label for="id-nomecategoria" class="col-sm-1-12 col-form-label">Nome da Categoria:</label><br />
                        <input type="text" maxlength="50" class="form-control" name="nomecategoria"  id="id-nomecategoria" value="<?php echo $categoria->__get('nome_categoria'); ?>" required  />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <!-- <button type="submit" class="btn btn-primary">Cadastrar</button> -->
                        <input type="submit" class="btn btn-primary" value="Atualizar">
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
