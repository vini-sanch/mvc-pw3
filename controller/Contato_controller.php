<?php
	include_once('../model/Usuario_model.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	require '../PHPMailer/Exception.php';
	require '../PHPMailer/PHPMailer.php';
	require '../PHPMailer/SMTP.php';

	if(isset($_GET['acao'])) {
		if($_GET['acao'] == '')
	}

	public function sendMail($email)
	{
		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);
		$from = 'testeaulateste@outlook.com';
		$pass = '@A12345678@';
		$nick = 'Projeto NOT';
		$title = 'Pedido de Troca de Senha';
		$message = 'Clique aqui para trocar a sua senha';
		$altMessage = '';
		$host = 'smtp.live.com';
		$token = md5(date('d-m-Y '));
		
		$usuario = new Usuario_model();
		$usuario = $usuario->retornarDados($email);

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = $host;                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = $from;                     // SMTP username
			$mail->Password   = $pass;                               // SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			$mail->Port       = 587;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom($from, $nick);
			$mail->addAddress($email);     // Add a recipient
			// $mail->addAddress('ellen@example.com');               // Name is optional
			// $mail->addReplyTo('info@example.com', 'Information');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');

			// Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $title;
			$mail->Body    = $message;
			$mail->AltBody = $altMessage;

			$mail->send();
			echo ```<script>alert("Dados enviados com sucesso!"); </script>```;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
?>