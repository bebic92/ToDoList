 <?php
class TasksController{

	public function index($id){
		$tasks = Task::all();
		//require 'views/index.view.php';
		return view('tasks',[
			'tasks' => $tasks
			]);
	}
	public function add(){
		$parameters=[

			'description' => $_POST['description'],
			'completed'=> $_POST['completed']];

			//App::get('database')->add('todos', $parameters);

			return header('Location: /Drugi_dio_b/tasks');

	}
		public function update(){
		$parameters=[
			'completed'=> $_POST['completed']];
			die($parameters['completed']); 
			//App::get('database')->update('todos', $parameters,'id',7);

			return header('Location:/tasks');

	}
}