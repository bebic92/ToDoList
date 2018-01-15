<?php

class User{

	public static function create($user){
		App::get('database')->add('users',$user);

	}
	public static function all(){
		return App::get('database')->getAll('users');
	}
	public static function find($field, $value){
		return App::get('database')->find('users',$field, $value);
	}
	public static function update($par, $par2, $rowName, $value){
		return App::get('database')->update('users',$par, $par2, $rowName, $value);
	}
}