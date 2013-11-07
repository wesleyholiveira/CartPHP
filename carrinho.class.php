<?php

include 'produto.class.php';

class Carrinho {

	public $cart;

	public function __construct() {$this->cart = array();}

	public function AddCart(Produto $item) {
		$id = -1;
		if (count($item->i) > 0) {
			foreach($item->i as $produto) {
				$id = $produto->getId();
				$this->cart[$id] = $produto;
				setcookie("produto_$id",$id);
			}
		}else {
			$id = $item->getId();
			$this->cart[$id] = $item;
			setcookie("produto_$id",$id);
		}
		sort($this->cart);
	}

	public function RemoveCart(Produto $item) {
		$id = -1;
		if (($iSize = count($item->i)) > 0) {
			for ($i = 0;$i < $iSize;$i++) {
				$id = $item->i[$i]->getId();
				unset($this->cart[$i]);
				unset($_COOKIE["produto_$id"]);
			}
		}else {
			$id = $item->getId();
			unset($this->cart[$id]);
			unset($_COOKIE["produto_$id"]);
		}
		sort($this->cart);
	}

	public function __destruct() {
		unset($this->cart);
	}

}