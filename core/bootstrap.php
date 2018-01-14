<?php
App::bind('config', require 'config.php');
// require 'core/database/QueryBuilder.php'; //koristimo autoload.php umjesto ovog
// require 'core/database/Connection.php';
// require 'core/Router.php';
// require 'core/Request.php';
App::bind('database',new QueryBuilder(
	Connection::make(App::get('config')['database'])
));

function view($page, $data =[]){
	extract($data);
	return require "views/{$page}.view.php";

}