<?php 

	require "./libs/PHPMailer/Exception.php";
	require "./libs/PHPMailer/OAuthTokenProvider.php";
	require "./libs/PHPMailer/OAuth.php";
	require "./libs/PHPMailer/PHPMailer.php";
	require "./libs/PHPMailer/SMTP.php";
	require "./libs/PHPMailer/POP3.php";


	// define o namespace
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;



	//Cria a classe de mensagem
	class Message{
		
		// atributos
		private $to = null;
		private $subject = null;
		private $message = null;
		public $status = array('code'=> null, 'status_description'=> '');

		// getters e setters
		public function __get($attribute){
			return $this->$attribute;
		}
		public function __set($attribute, $value){
			$this->$attribute = $value;
		}

		//Demais métodos
		public function ValidMessage(){
			if (empty($this->to) || empty($this->subject) || empty($this->message)) {
				return false;
			}else{
				return true;
			}
		}

	}

	//Cria objeto mensagem
	$message = new Message();

	$message->__set('to', $_POST['to']);
	$message->__set('subject', $_POST['subject']);
	$message->__set('message', $_POST['message']);


	//testa se a mensagem é valida

	if (!$message->ValidMessage()) {
	 	echo 'A mensagem não é válida';
	 	header('Location: index.php');
	 	die();
	}

	
	//PHPMailer
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = false;//SMTP::DEBUG_SERVER;                      //Enable verbose debug output
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = '';                     //SMTP username
	    $mail->Password   = '';                               //SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	    //Recipients
	    $mail->setFrom('', 'Send Mail');
	    $mail->addAddress($message->__get('to'));     //Add a recipient
	    //$mail->addAddress('ellen@example.com');               //Name is optional
	    //$mail->addReplyTo('info@example.com', 'Information');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('bcc@example.com');

	    //Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = $message->__get('subject');
	    $mail->Body    = $message->__get('message');
	    $mail->AltBody = $message->__get('message');

	    $mail->send();
	    
	    $message->status['code'] = 1;
		$message->status['status_description'] = 'E-mail enviado com sucesso';

	} catch (Exception $e) {
	    $message->status['code'] = 2;
		$message->status['status_description'] = 'Não foi possivel enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail->ErrorInfo;
	}

 ?>

 <html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	</head>

	<body>

		<div class="container my-5">
	        <div class="text-center">
	        	<img src="img/logo.png" alt="" width="72" height="72" class="d-block mx-auto mb-2">
	        	<h2>Send Mail</h2>
	        	<p class="lead">Seu app de envio de e-mails particular!</p>
	      	</div>

			<div class="row">
				<div class="col-md-12">

					<?php if($message->status['code'] == 1) { ?>

						<div class="container">
							<h1 class="display-4 text-success">Sucesso</h1>
							<p><?= $message->status['status_description'] ?></p>
							<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
						</div>

					<?php } ?>

					<?php if($message->status['code'] == 2) { ?>

						<div class="container">
							<h1 class="display-4 text-danger">Ops!</h1>
							<p><?= $message->status['status_description'] ?></p>
							<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
						</div>

					<?php } ?>

				</div>
			</div>
		</div>

	</body>
</html>