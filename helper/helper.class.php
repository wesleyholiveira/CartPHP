<?php

abstract class Helper {
	public static function getVarName($var) {
		foreach($GLOBALS as $key => $value)
			if ($value === $var)
				return $key;
		return NULL;
	}
}