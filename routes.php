<?php

$router->get('Drugi_dio_b','PagesController@main');
// $router->get('Drugi_dio_b/contact','PagesController@contact');
$router->get('Drugi_dio_b/registracija','UserController@create');
$router->get('Drugi_dio_b/login','UserController@signIn');
$router->get('Drugi_dio_b/tasks','TasksController@index');
// $router->get('about/culture','controllers/about-culture.php');
$router->post('Drugi_dio_b/addTask','TasksController@add');
//$router->post('updateTask','TasksController@update');
$router->post('Drugi_dio_b/registracija','UserController@store');
$router->get('Drugi_dio_b/verify','UserController@verify');
$router->post('Drugi_dio_b/login','UserController@loginUser');
$router->get('Drugi_dio_b/odjava','UserController@logoutUser');
$router->get('Drugi_dio_b/todos','TodoController@allTodos');
// $router->get('Drugi_dio_b/todos/?','TodoController@sort');
$router->get('Drugi_dio_b/todos/kreiraj','TodoController@createTodo');
$router->post('Drugi_dio_b/todos/kreiraj','TodoController@storeTodo');
$router->post('Drugi_dio_b/todos/delete','TodoController@deleteTodo');
$router->get('Drugi_dio_b/todo/tasks/{id}','TodoController@show');
$router->get('Drugi_dio_b/todo/task/create','TasksController@create');
$router->post('Drugi_dio_b/todo/task/create','TasksController@store');
$router->post('Drugi_dio_b/task/delete','TasksController@delete');
$router->get('Drugi_dio_b/todo/tasks/sort','TasksController@getAndSortTasks');
$router->get('Drugi_dio_b/todo/task/update/{id}','TasksController@updatePage');
$router->post('Drugi_dio_b/todo/task/update','TasksController@update');