<?php

class TodoController {

	public function __construct(){
		if(!isset($_SESSION['user_id'])){
			return header('Location: /Drugi_dio_b/');
		}

	}

	public function allTodos(){

		// $todos = App::get('database')->findAll('todos','user_id',$_SESSION['user_id']);
		// $tasks = App::get('database')->findAll('tasks','user_id',$_SESSION['user_id']);	
		$todos = new Todo;
		$todosTasks = $todos->todos($_SESSION['user_id']);
		return view('todos/show', ['todos'=> $todosTasks]);
	}
	public function sort(){
		$todos = new Todo;
		if($_POST['sort'] == "naziv_asc"){
			$_SESSION['todos'] = $todos->todosSort($_SESSION['user_id'],'listName','ASC');
		};
		if($_POST['sort'] == "naziv_desc"){
			$_SESSION['todos'] = $todos->todosSort($_SESSION['user_id'],'listName','DESC');
		};
		if($_POST['sort'] == "vrijeme_desc"){
			$_SESSION['todos'] = $todos->todosSort($_SESSION['user_id'],'created_at','DESC');
		};
		if($_POST['sort'] == "vrijeme_asc"){
			$_SESSION['todos'] = $todos->todosSort($_SESSION['user_id'],'created_at','ASC');
		};
		return header('Location: /Drugi_dio_b/todos/');
	}

	public function createTodo(){
		return view('todos/create');
	}

	public function storeTodo(){
		if(isset($_SESSION['todos'])){unset($_SESSION['todos']);};
		$todo = [
		'listName' => $_POST['nazivListe'],
		'created_at' => date('Y-m-d H:i:s'),
		'user_id' => $_SESSION['user_id']
		];
		$errors = $this->validateTodo($todo);
		if(!empty($errors)){
			$_SESSION['errors'] = $errors;
			return header('Location: /Drugi_dio_b/todos/kreiraj/');
		};

		App::get('database')->add('todos', $todo);
		return header('Location: /Drugi_dio_b/todos');
	}

	protected function validateTodo($todo){

		$errors['todo_req'] = Validator::required($todo['listName'], 'Naziv liste');

		foreach ($errors as $error) {
			if(!empty($error)){
				return $errors;
			}
			return;
		}
	}
	public function deleteTodo(){
		if(isset($_SESSION['todos'])){unset($_SESSION['todos']);};{
		App::get('database')->delete('todos', 'id', $_POST['id']);
	}
		return header('Location: /Drugi_dio_b/todos/');
	}

}