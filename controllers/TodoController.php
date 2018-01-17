<?php

class TodoController {

	public function __construct(){
		if(!isset($_SESSION['user_id'])){
			return header('Location: /Drugi_dio_b/');
		}
		if(isset($_SESSION['task_id'])){ unset($_SESSION['task_id']);}

	}

	public function allTodos(){

		// $todos = App::get('database')->findAll('todos','user_id',$_SESSION['user_id']);
		// $tasks = App::get('database')->findAll('tasks','user_id',$_SESSION['user_id']);
		if(isset($_GET['sort'])){
			$_SESSION['sort_todos'] = $_GET['sort'];
			$this->getAndSort();		
		}
		if(isset($_SESSION['sort_todos'])){
			return view('todos/show', ['todos'=> $_SESSION['sort_todos']]);
		}
		$todos = new Todo;
		$todosTasks = $todos->todos($_SESSION['user_id']);
		return view('todos/show', ['todos'=> $todosTasks]);
	}
	public function getAndSort(){
		$todos = new Todo;
		if($_SESSION['sort_todos'] == "naziv_asc"){
			$_SESSION['todos'] = $todos->todosSort($_SESSION['user_id'],'listName','ASC');
		};
		if($_SESSION['sort_todos'] == "naziv_desc"){
			$_SESSION['todos'] = $todos->todosSort($_SESSION['user_id'],'listName','DESC');
		};
		if($_SESSION['sort_todos'] == "vrijeme_desc"){
			$_SESSION['todos'] = $todos->todosSort($_SESSION['user_id'],'created_at','DESC');
		};
		if($_SESSION['sort_todos'] == "vrijeme_asc"){
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
		$this->getAndSort();
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
		if(isset($_SESSION['todos'])){unset($_SESSION['todos']);
		App::get('database')->delete('todos', 'id', $_POST['id']);
	}
		$this->getAndSort();
	}

	public function show($todoId){
		$todo = new Todo;
		$todoDetails = $todo->todoDetails($_SESSION['user_id'],$todoId);
		if(!empty($todoDetails)){
			if($todoDetails->num_task != 0){
				$avg=($todoDetails->num_task - $todoDetails->uncompleted);
				$avg = ($avg / $todoDetails->num_task) * 100;
			}else{
				$avg = "";
			}
				
			if(isset($_SESSION['sort_tasks']) && $_SESSION['todo_id'] == $todoId){
			return view('todos/showDetails',[
				'todo' => $todoDetails, 
				'avg' => $avg,
				'todoTasks' => $_SESSION['tasks']
				]);

			}
			$_SESSION['todo_id'] = $todoDetails->todoId;
			$todoTasks = $todo->todoTasks($todoId); 
			return view('todos/showDetails',[
				'todo' => $todoDetails, 
				'avg' => $avg,
				'todoTasks' => $todoTasks
				]);

		}else{
			return header('Location: /Drugi_dio_b/todos');
		}
	}
}