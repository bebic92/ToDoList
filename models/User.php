<?php

class User{

	public static function create($user){
		App::get('database')->add('users',$user);

	}
	public static function all(){
		return App::get('database')->getAll('users');
	}
}