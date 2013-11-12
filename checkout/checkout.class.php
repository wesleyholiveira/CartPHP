<?php

define('CHECK_ORCAMENTO',1);
define('CHECK_BCASH',2);

require 'phpmailer/class.phpmailer.php';
require 'checkout/actioncheckout.class.php';

class Checkout extends ActionCheckout {

	private $Cart;

	public function __construct(Carrinho $cart=NULL,$checkID=0) {
		if ($cart != NULL) {
			$this->Cart = $cart;
			$this->checkOpts = array(
				'assunto' => 'Orçamentos',
				'remetente' => 'suporte@manaweb.com.br',
				'nomeRemetente' => 'Suporte Maná WEB',
				'destino' => array('Wesley' => 'wesleyfetish@gmail.com'),
				'corpo' => 'HTML'
			);
			$this->loadCheckout($checkID);
		}
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

	public function loadCheckout($checkID) {
		switch($checkID) {
			case $checkID&CHECK_ORCAMENTO:
				$this->sendConfirm($this->checkOpts);
			break;
			case $checkID&CHECK_BCASH:
				$this->sendBCash($this->Cart);
			break;
			case $checkID&(CHECK_ORCAMENTO|CHECK_BCASH):
				$this->sendConfirm($this->checkOpts);
				$this->sendBCash($this->Cart);
			break;
			default: break;
		}
	}
}
