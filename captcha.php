<?php
  include_once('controller/Usuario_controller.php');

  var_dump(isset($_SESSION['captcha']));
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
            <div class="card-header"><h3>Você fez muitas tentativas!</h3></div>
            <div class="card-body">
              <form action="?acao=confirmar_captcha" method="POST">
                <label for="id-calculo">Qual é o resultado de <?php echo rand(1, 20) . ' + ' . rand(1, 20); ?>?</label>
                <input class="form-control" type="text" name="calculo" id="id-calculo" required />
                <br/><br/>
                <input type="submit" class="btn btn-info" id="id-confirmar" value="Confirmar" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>
