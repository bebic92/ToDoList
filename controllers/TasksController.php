 <?php
class TasksController{

	public function create(){

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
		App::get('database')->add('tasks', $task);
		if(isset($_SESSION['sort_tasks'])){
			$this->getAndSortTasks();
		}
		$newTasks = new Todo;
		$_SESSION['tasks'] = $newTasks->todoTasks($_SESSION['todo_id']);
		return header('Location: /Drugi_dio_b/todo/tasks/'. $_SESSION['todo_id']);
	}
	public function update(){
		$parameters=[
			'completed'=> $_POST['completed']];
			die($parameters['completed']); 
			//App::get('database')->update('todos', $parameters,'id',7);

			return header('Location:/tasks');

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