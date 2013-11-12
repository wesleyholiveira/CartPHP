<?php

include_once 'helper/helper.class.php';

class Produto {

	public $i;
	private $id, $nome, $descricao, $preco;
	private $disp, $qtd;

	public function __construct() {
		$this->i = array();
		$argc = func_num_args();
		$argv = func_get_args();
		foreach($argv as $param) {
			if (!is_array($param)) {
				$vName = ucfirst(Helper::getVarName($param));
				$this->$vName = $param;
			}else {
				if (!is_array($param))
					$this->$key = $param;
				else {
					foreach($param as $key => $value)
						$this->$key = $value;
				}
			}
			$this->i[] = clone $this;
		}
	}

	public function setId($id) {
		$this->id = (int)$id; 
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}

	public function setPreco($preco) {
		$this->preco = (float)$preco;
	}

	public function setQtd($qtd) {
		$this->qtd = (int)$qtd;
	}

	public function setDisp($disp) {
		$this->disp = (boolean)$disp;
	}

	public function getId() {
		return $this->id;
	}

	public function getNome() {
		return utf8_decode($this->nome);
	}

	public function getDescricao() {
		return utf8_decode($this->descricao);
	}

	public function getPreco() {
		return $this->preco;
	}

	public function getQtd() {
		return $this->qtd;
	}

	public function getDisp() {
		return $this->disp;
	}

	public function __destruct() {
		unset($this->i);
	}

}