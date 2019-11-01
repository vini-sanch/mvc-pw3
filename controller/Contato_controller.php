<?php
	include_once('model/Email_model.php');

	if(isset($_GET['acao'])) {
		if($_GET['acao'] == 'contatar') {
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$mensagem = $_POST['mensagem'];
			$telefone = $_POST['tel'];

			$mailer = new Email_model();
			$msg = "Nome: $nome | Telefone: $telefone | Recado: $mensagem";
			$msgHtml = "<p>Nome: $nome</p><p>Telefone: $telefone</p><p>" . $mensagem . "<p>";

			/* Informações do E-mail */
			$mailer->__set('destinatario', $email);
			$mailer->__set('mensagem', $msg);
			$mailer->__set('mensagemHTML', $msgHtml);
			$mailer->__set('assunto', "Oi, $nome");

			// enviando o e-mail
			$failed = $mailer->sendMail();
			if (!empty($failed)) {
				echo "<script>alert('Ocorreu algum erro: \n " . $failed . " ');</script>";
			} else {
				echo "<script>alert('E-mail enviado com sucesso!');</script>";
			}

			echo "<script>window.location.href = 'contato.php'</script>";
		}
	}
?>
