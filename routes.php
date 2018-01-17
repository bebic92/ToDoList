<?php

//pocetna stranica
$router->get('Drugi_dio_b','PagesController@main');
//rute vezane za registriranje, login, odjavu korisnika
$router->get('Drugi_dio_b/register','UserController@create');
$router->get('Drugi_dio_b/login','UserController@signIn');
$router->get('Drugi_dio_b/verify','UserController@verify');
$router->post('Drugi_dio_b/login','UserController@loginUser');
$router->get('Drugi_dio_b/logout','UserController@logoutUser');
$router->post('Drugi_dio_b/register','UserController@store');
//Vezane za prikaz, kreiranje, i brisanje listi
$router->get('Drugi_dio_b/todos','TodoController@allTodos');
$router->get('Drugi_dio_b/todos/create','TodoController@createTodo');
$router->post('Drugi_dio_b/todos/create','TodoController@storeTodo');
$router->post('Drugi_dio_b/todos/delete','TodoController@deleteTodo');
//Za prikaz detalja određene liste
$router->get('Drugi_dio_b/todo/tasks/{id}','TodoController@show');
//Vezane za spremanje, brisanje, dodavanje, i uređivanje zadataka
$router->get('Drugi_dio_b/todo/task/create','TasksController@create');
$router->post('Drugi_dio_b/todo/task/create','TasksController@store');
$router->post('Drugi_dio_b/task/delete','TasksController@delete');
$router->get('Drugi_dio_b/todo/task/update/{id}','TasksController@updatePage');
$router->post('Drugi_dio_b/todo/task/update','TasksController@update');
$router->get('Drugi_dio_b/todo/tasks/sort','TasksController@getAndSortTasks');