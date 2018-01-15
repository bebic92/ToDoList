<?php

class Validator{


	public static function required($data, $fieldName){
		if(empty($data)){
			return ucfirst($fieldName) .' polje ne smije biti prazno';
		}
		return;
	}
	public static function email($data){
		if(!filter_var($data, FILTER_VALIDATE_EMAIL)){
			return 'Niste upisali ispravnu email adresu';
		}
		return;
	}
	public static function unique($table, $row, $data, $fieldName){

		$data = App::get('database')->find($table, $row, $data);
		if(!empty($data)){
			return 'Polje '.ucfirst($fieldName).' treba biti jedinstveno';
		}
		return;
	}

	public static function max($data, $fieldName, $value){
		if(strlen($data) > $value){
			return 'Maksimalan broj znakova za polje '.ucfirst($fieldName).' je '.$value;
		}else
		return;
	}
	public static function min($data, $fieldName, $value){
		if(strlen($data) < $value){
			return 'Minimalan broj znakova za polje '. ucfirst($fieldName) .' je '. $value;
		}else
		return;
	}
}