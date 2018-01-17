<?php

class Todo{
	
	protected $pdo;
	// spajamo se na bazu
	public function __construct(){

		$this->pdo = Connection::make(App::get('config')['database']);
	}
	//dohvaćamo sve liste koje su vezane za logiranog korisnika
	public function todos($user_id){
		$sql = 'SELECT listName, created_at, tasks.id as taskId, todos.id as todoId , status, user_id, count(tasks.id) as num_task,
		count(case when status = "0" then 1 else null end) as uncompleted
		FROM todos  
		LEFT JOIN tasks
		ON todos.id = tasks.todo_id
		WHERE user_id ='. $user_id .'
		group by todos.id
		ORDER BY created_at DESC';

		$statment = $this->pdo->prepare($sql);
		$statment->execute();
		return $statment->fetchAll(PDO::FETCH_CLASS);
	}
	//sortiramo i dohvaćamo sve liste
	public function todosSort($user_id, $by, $how){
		$sql = 'SELECT listName, created_at, tasks.id as taskId, todos.id as todoId , status, user_id, count(tasks.id) as num_task,
		count(case when status = "0" then 1 else null end) as uncompleted
		FROM todos  
		LEFT JOIN tasks
		ON todos.id = tasks.todo_id
		WHERE user_id ='. $user_id .'
		group by todos.id
		ORDER BY '.$by. ' ' .$how.'';
		
		$statment = $this->pdo->prepare($sql);
		$statment->execute();
		return $statment->fetchAll(PDO::FETCH_CLASS);
	}
	//dohvaćamo detalje liste na koju je korisnik kliknuo
	public function todoDetails($user_id, $todo_id){
		$sql = 'SELECT listName, created_at, tasks.id as taskId, todos.id as todoId , status, user_id, count(tasks.id) as num_task,
		count(case when status = "0" then 1 else null end) as uncompleted
		FROM todos  
		LEFT JOIN tasks
		ON todos.id = tasks.todo_id
		WHERE todos.id ='. $todo_id .' AND user_id ='. $user_id .' 
		group by todos.id';

		$statment = $this->pdo->prepare($sql);
		$statment->execute();
		return $statment->fetch(PDO::FETCH_OBJ);
	}

	// dohvaćamo sve zadatke koji su vezani za selektiranu listu
	public function todoTasks($todoId){
		{
			$sql = 'SELECT taskName, priority, deadline, id as taskId, 
			todo_id as todoId , status, DATEDIFF(deadline,NOW()) as DateDiff
			FROM tasks  
			WHERE todo_id ='. $todoId .'
			group by tasks.id
			ORDER BY priority';

			$statment = $this->pdo->prepare($sql);
			$statment->execute();

			return $statment->fetchAll(PDO::FETCH_CLASS);
		}
	}
}