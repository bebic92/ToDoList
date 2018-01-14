<?php

$router->get('Drugi_dio_b','PagesController@main');
$router->get('Drugi_dio_b/about','PagesController@about');
$router->get('Drugi_dio_b/contact','PagesController@contact');
$router->get('Drugi_dio_b/registracija','UserController@create');
$router->get('Drugi_dio_b/tasks','TasksController@index');
// $router->get('about/culture','controllers/about-culture.php');
$router->post('Drugi_dio_b/addTask','TasksController@add');
//$router->post('updateTask','TasksController@update');
$router->post('Drugi_dio_b/registracija','UserController@store');
$router->get('Drugi_dio_b/verify','UserController@verify');