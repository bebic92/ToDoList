 <?php
class TasksController{

	public function create(){
		if(isset($_SESSION['tasks'])){unset($_SESSION['tasks']);}
		return view('task/create');
	}

	public function store(){
		$task = [
		'todo_id' => $_SESSION['todo_id'],
		'taskName' => $_POST['taskName'],
		'priority' => $_POST['priority'],
		'deadline' => $_POST['deadline'],
		'status' => $_POST['status'],
		];

		$errors = $this->validateTask($task);

		if(!empty($errors)){
			return view('task/create',['errors' => $errors]);
		}
		App::get('database')->add('tasks', $task);
		$_SESSION['task_details_change'] = true;
		if(isset($_SESSION['sort_tasks'])){
			$this->getAndSortTasks();
		}
		$newTasks = new Todo;
		$_SESSION['tasks'] = $newTasks->todoTasks($_SESSION['todo_id']);
		return header('Location: /Drugi_dio_b/todo/tasks/'. $_SESSION['todo_id']);
	}
	public function updatePage($id){
		if(isset($_SESSION['todo_id'])){
		$task = new Task;
		$task = $task->taskDetails($_SESSION['todo_id'], $id);
			if(!empty($task)){
				return view('task/update', ['task' => $task]);
			}
		}
		return header('Location: /Drugi_dio_b/todos/');
	}
	public function update(){
		$taskUpdate = [
		'todo_id' => $_SESSION['todo_id'],
		'taskName' => $_POST['taskName'],
		'priority' => $_POST['priority'],
		'deadline' => $_POST['deadline'],
		'status' => $_POST['status'],
		];
		$taskId = $_POST['task_id'];
		$_SESSION['errors'] = $this->validateTask($taskUpdate);
		if(!empty($_SESSION['errors'])){
			return header('Location: /Drugi_dio_b/todo/task/update/'. $_POST['task_id']);
		}
		unset($_SESSION['errors']);
		$task = new Task;
		$task->update('tasks', $taskUpdate, 'id', $taskId);
		$_SESSION['task_details_change'] = true;
		$this->getAndSortTasks();

	}
	public function getAndSortTasks(){
		if(isset($_GET['sort_tasks'])){
			$_SESSION['sort_tasks'] = $_GET['sort_tasks'];
		}
		$task = new Task;
		if($_SESSION['sort_tasks'] == "naziv_asc"){
			$_SESSION['tasks'] = $task->sortTasks( $_SESSION['todo_id'],'taskName','ASC');
		};
		if($_SESSION['sort_tasks'] == "naziv_desc"){
			$_SESSION['tasks'] = $task->sortTasks( $_SESSION['todo_id'],'taskName','DESC');
		};
		if($_SESSION['sort_tasks'] == "status_desc"){
			$_SESSION['tasks'] = $task->sortTasks( $_SESSION['todo_id'],'status','ASC');
		};
		if($_SESSION['sort_tasks'] == "status_asc"){
			$_SESSION['tasks'] = $task->sortTasks( $_SESSION['todo_id'],'status','DESC');
		};
		if($_SESSION['sort_tasks'] == "prioritet_desc"){
			$_SESSION['tasks'] = $task->sortTasks( $_SESSION['todo_id'],'priority','ASC');
		};
		if($_SESSION['sort_tasks'] == "prioritet_asc"){
			$_SESSION['tasks'] = $task->sortTasks( $_SESSION['todo_id'],'priority','DESC');
		};
		if($_SESSION['sort_tasks'] == "datum_zavrsetka_desc"){
			$_SESSION['tasks'] = $task->sortTasks( $_SESSION['todo_id'],'deadline','ASC');
		};
		if($_SESSION['sort_tasks'] == "datum_zavrsetka_asc"){
			$_SESSION['tasks'] = $task->sortTasks( $_SESSION['todo_id'],'deadline','DESC');
		};
		return header('Location: /Drugi_dio_b/todo/tasks/'.$_SESSION['todo_id']);
	}
	public function validateTask($task){
		//validacija taska
		$errors['taskName_req']= Validator::required($task['taskName'],'Ime zadatka');
		$errors['deadline_req']= Validator::required($task['deadline'],'Rok završetka');
		$errors['deadline_date']= Validator::dateMin($task['deadline'],'Datum ', date('Y-m-d'));
		foreach ($errors as $error) {
			if(!empty($error)){
				return $errors;
			}
			return;
		}
		
	}
	public function delete(){

		App::get('database')->delete('tasks', 'id', $_POST['task_id']);
		if(isset($_SESSION['sort_tasks'])){
			$this->getAndSortTasks();
		}
		$newTasks = new Todo;
		$_SESSION['tasks'] = $newTasks->todoTasks($_SESSION['todo_id']);
		return header('Location: /Drugi_dio_b/todo/tasks/'. $_SESSION['todo_id']);
	}
}