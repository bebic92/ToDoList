<?php

class Validator{


	public static function required($data){
		if(empty($data)){
			return 'Ovo polje ne smije biti prazno';
		}
		return;
	}
	public static function email($data){
		if(!filter_var($data, FILTER_VALIDATE_EMAIL)){
			return 'Niste upisali ispravnu email adresu';
		}
		return;
	}
	public static function unique($data, $table, $row){

		$data = App::get('database')->find($table, $row, $data);
		if(!empty($data)){
			return 'Ovo polje treba biti jedinstveno';
		}
		return;
	}

	public static function max($data, $value){
		if(strlen($data) > $value){
			return 'Maksimalan broj znakova je '.$value;
		}else
		return;
	}
	public static function min($data, $value){
		if(strlen($data) < $value){
			return 'Minimalan broj znakova je '. $value;
		}else
		return;
	}
}