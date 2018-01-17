<?php
//bindamo config podatke
App::bind('config', require 'config.php');

//dohvaćamo podatke o bazi, spajamo se na bazu putem Connection Klase, te u query Builderu
//u $pdo spremamo podatke o bazi na koju se spajamo, nakon cega dalje manipuliramo podatcima u bazi
App::bind('database',new QueryBuilder(
	Connection::make(App::get('config')['database'])
));
//view bolje bi bilo da je u helpers fileu ali posto je sama ostavio sam je ovdje
function view($page, $data =[]){
	extract($data);
	return require "views/{$page}.view.php";

}