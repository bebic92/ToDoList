<?php

class User{
	
	//spremamo korisnika u bazu
	public static function create($user){
		App::get('database')->add('users',$user);
	}
	//dohvaćamo sve korisnike
	public static function all(){
		return App::get('database')->getAll('users');
	}
	//dohvaćamo određenog korisnika
	public static function find($field, $value){
		return App::get('database')->find('users',$field, $value);
	}
	// ažuriramo podatke određenog korisnika (u nasem slucaju status kod verifikacije)
	public static function update($par, $par2, $rowName, $value){
		return App::get('database')->update('users',$par, $par2, $rowName, $value);
	}
}