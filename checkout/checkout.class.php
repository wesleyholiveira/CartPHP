<?php

define('CHECK_ORCAMENTO',1);
define('CHECK_BCASH',2);

require 'phpmailer/class.phpmailer.php';

class Checkout {

	public $checkOpts;
	private $Cart;

	public function __construct(Carrinho $cart=NULL,$checkID=0) {
		if ($cart != NULL)
			$this->loadCheckout($cart,$checkID);
	}

	/*
		Setter e Getters
	*/
	public function setCheckOpts($key,$value) {
		$this->checkOpts[$key] = $value;
	}

	public function getCheckOpts($key) {
		return $this->checkOpts[$key];
	}

	public function loadCheckout($cart,$checkID) {
		$this->Cart = $cart;
		switch($checkID) {
			case $checkID&CHECK_ORCAMENTO:
				$this->enviarConfirmacao($this->checkOpts);
			break;
			case $checkID&CHECK_BCASH:
				echo 'BCASH';
			break;
			case $checkID&(CHECK_ORCAMENTO|CHECK_BCASH):
				echo 'BAZINGA';
			break;
			default: break;
		}
	}
	/*
		$checkOpts = array(
			'assunto' => 'Orçamentos',
			'remetente' => 'suporte@manaweb.com.br',
			'nomeRemetente' => 'Suporte Maná WEB',
			'destino' => array('White Weslie' => 'wesleyfetish@gmail.com','Dark Weslie' => 'wesley.santos@cudoce.com'),
			'corpo' => 'HTML'
		)
	*/
	private function enviarConfirmacao($checkOpts) {
		try {
			$mail = new PHPMailer(true);
			$mail->isSMTP();
			//$mail->SMTPDebug  = 2;                     enables SMTP debug information (for testing)
			$mail->Host       = "smtp.gmail.com"; // SMTP server
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "manawebsuporte@gmail.com";  // GMAIL username
			$mail->Password   = "****";            // GMAIL password
			$mail->From = $checkOpts['remetente'];
			$mail->Sender = $checkOpts['remetente'];
			$mail->FromName = $checkOpts['nomeRemetente'];

			foreach($checkOpts['destino'] as $name => $mails)
				$mail->AddAddress($mails,utf8_decode($name));

			$mail->IsHTML(true);
			$mail->Subject = utf8_decode($checkOpts['assunto']);
			$mail->Body = utf8_decode($checkOpts['corpo']);
			$mail->Send();
		}catch(phpmailerException $e) {
			echo $e->errorMessage();
		}catch(Exception $e) {
			echo $e->getMessage();
		}
	}
}