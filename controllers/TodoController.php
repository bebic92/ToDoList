<?php

class TodoController {
	//samo logirani korisnik ima pristup metodama, 
	public function __construct(){
		if(!isset($_SESSION['user_id'])){
			return header('Location: /Drugi_dio_b/');
		}
		if(isset($_SESSION['task_id'])){ unset($_SESSION['task_id']);}

	}

	//prikaz svih listi
	public function allTodos(){
		//ako je korisnik kliknuo botun sort 
		if(isset($_GET['sort'])){
			$_SESSION['sort_todos'] = $_GET['sort'];
			$this->getAndSort();		
		}
		//ako su se dogodile promjene u bazi vezane za task, i ako je task sortiran
		if(isset($_SESSION['task_details_change']) && isset($_SESSION['sort_todos'])){
			$this->getAndSort();
			return view('todos/show', ['todos'=> $_SESSION['todos']]);
		}
		// ako su već sortirani
		if(isset($_SESSION['sort_todos'])){
			return view('todos/show', ['todos'=> $_SESSION['todos']]);
		}

		//ako nije nista od navedenog dohvati i prikazi
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
		if(isset($_SESSION['task_details_change'])){
			unset($_SESSION['task_details_change']);
			return;
		}
		return header('Location: /Drugi_dio_b/todos/');
	}
	// prikaz stranice za kreiranje todo-a
	public function createTodo(){
		return view('todos/create');
	}

	public function storeTodo(){
		
		//dohvaćanje podataka
		$todo = [
		'listName' => $_POST['nazivListe'],
		'created_at' => date('Y-m-d H:i:s'),
		'user_id' => $_SESSION['user_id']
		];
		// provjera gresaka
		$errors = $this->validateTodo($todo);
		if(!empty($errors)){
			$_SESSION['errors'] = $errors;
			return header('Location: /Drugi_dio_b/todos/kreiraj/');
		};
		// ako je sve uredu spremi
		App::get('database')->add('todos', $todo);
		if(isset($_SESSION['todos'])){unset($_SESSION['todos']);};
		//ako su vec sortirani dohvati i sortiraj ponovo, ako ne idi na dohvaćanje i provjeri razlicite uvjete
		if(isset($_SESSION['sort_todos'])){
			$this->getAndSort();
		}else{
			$this->allTodos();
		}
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
	// brisanje
	public function deleteTodo(){
		App::get('database')->delete('todos', 'id', $_POST['id']);

		if(isset($_SESSION['todos'])){unset($_SESSION['todos']);}
		if(isset($_SESSION['sort_todos'])){
			$this->getAndSort();
		}else{
			$this->allTodos();
		}
	}
	// prikaz detalja određene todo liste
	public function show($todoId){
		//pronađi listu na koju je korisnik kliknuo
		$todo = new Todo;
		$todoDetails = $todo->todoDetails($_SESSION['user_id'],$todoId);
		if(!empty($todoDetails)){
			//ako je broj taskova veci od  izracunaj napredak
			if($todoDetails->num_task != 0){
				$avg=($todoDetails->num_task - $todoDetails->uncompleted);
				$avg = ($avg / $todoDetails->num_task) * 100;
			}else{
				$avg = "";
			}
			//ako je korisnik već bio u  tasku	
			if(isset($_SESSION['sort_tasks']) && $_SESSION['todo_id'] == $todoId && isset($_SESSION['tasks'])){
			return view('todos/showDetails',[
				'todo' => $todoDetails, 
				'avg' => $avg,
				'todoTasks' => $_SESSION['tasks']
				]);

			}
			// ako je korisnik kliknuo na neki drugi task 
			$_SESSION['todo_id'] = $todoDetails->todoId;
			$todoTasks = $todo->todoTasks($todoId); 
			return view('todos/showDetails',[
				'todo' => $todoDetails, 
				'avg' => $avg,
				'todoTasks' => $todoTasks
				]);

		}else{// ako nije nista od navedenog
			return header('Location: /Drugi_dio_b/todos');
		}
	}
}