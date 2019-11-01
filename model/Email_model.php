<?php
	require 'PHPMailer\Exception.php';
	require 'PHPMailer\PHPMailer.php';
	require 'PHPMailer\SMTP.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	class Email_model {
		private $mail;
		private $destinatario;
		private $assunto;
		private $mensagemHTML;
		private $mensagem;

		public function __get($field)
		{
			return $this->$field;
		}
		public function __set($field, $value)
		{
			$this->$field = $value;
		}

		function __construct()
		{
			$this->mail = new PHPMailer();

			$from = 'teste2aulateste@outlook.com';
			$nick = 'Projeto NOT';

			// $mail = new PHPMailer(true);
			// $from = 'teste2aulateste@outlook.com';
			// $pass = '@A12345678@';
			// $nick = 'Projeto NOT';
			// $title = 'Pedido de Troca de Senha';
			// $message = 'Clique aqui para trocar a sua senha';
			// $altMessage = '';
			// $host = 'smtp.live.com';
			// $token = md5(date('d-m-Y '));

			/* configuração do SMTP */
			$this->mail->isSMTP();
			//$this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$this->mail->SMTPAuth = true;
			$this->mail->Port = 587;

			/* Setando informações de servidor */
			$this->mail->Host = 'smtp.live.com';
			$this->mail->Username = $from;
			$this->mail->Password = '@A12345678@';
			$this->mail->setFrom($from, $nick);
			$this->mail->isHTML(true);
		}

		public function sendMail()
		{
			try {
				$this->mail->addAddress($this->destinatario);
				$this->mail->Subject = $this->assunto;
				$this->mail->Body = $this->mensagemHTML;
				$this->mail->AltBody = $this->mensagem;
				$this->mail->send();

				return null;
			} 
			catch (Exception $e) {

				return $e;
			}
		}
	}
?>
