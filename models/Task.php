<?php

class Task{
	protected $pdo;

	public function __construct(){

		$this->pdo = new QueryBuilder( Connection::make(App::get('config')['database']));
	}

	public static function all(){
		return App::get('database')->getAll('todos'); 
	}
}