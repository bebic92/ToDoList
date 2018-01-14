<?php
session_start();
//$pdo = connectToDb();
require 'vendor/autoload.php';
$query = require 'core/bootstrap.php';

// $router = new Router;

// require 'routes.php';


// require $router->direct($uri);

Router::load('routes.php')
	->direct(Request::uri(),Request::method());
