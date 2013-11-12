<?php

abstract class Helper {
	public static function getVarName($var) {
		foreach($GLOBALS as $key => $value)
			if ($value === $var)
				return $key;
		return NULL;
	}
	public static function BCashFormToProduct($post) {
		$bcash[0] = new Produto;
		$bcash[1] = new stdClass;
		for ($i = 0;($id = @$post['produto_codigo_'.($i+1)]) != NULL;$i++) {
			$ri = $i+1;
			$bcash[0]->i[$i] = clone $bcash[0];
			$bcash[0]->i[$i]->setId($id);
			$bcash[0]->i[$i]->setDescricao($post['produto_descricao_'.$ri]);
			$bcash[0]->i[$i]->setQtd($post['produto_qtde_'.$ri]);
			$bcash[0]->i[$i]->setPreco($post['produto_valor_'.$ri]);
			unset($post['produto_codigo_'.$ri]);
			unset($post['produto_descricao_'.$ri]);
			unset($post['produto_qtde_'.$ri]);
			unset($post['produto_valor_'.$ri]);
		}
		foreach($post as $key => $data)
			$bcash[1]->$key = $data;
		return $bcash;
	}
}