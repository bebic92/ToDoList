<?php
class Connection{
	
	public static function make($config){
		try{
			
			return new PDO(
				$config['type'].':'.
				$config['connection'].';dbname='. 
				$config['name'],
				$config['username'],
				$config['password'],
				$config['options']
				);
		}catch (Exepction $e){
			die('Greska');
		}
	}
}