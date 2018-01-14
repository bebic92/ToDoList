<?php
class Router{
	protected $routes =[
		'GET' => [],
		'POST' => []
	];

	public function get($uri, $controller){
		$this->routes['GET'][$uri] = $controller;
	}
	public function post($uri, $controller){
		$this->routes['POST'][$uri] = $controller;
	}
	public static function load($file){
		$router = new static;

		require $file;
		
		return $router;
	}
	public function direct($uri, $requestType){
		$int = filter_var($uri, FILTER_SANITIZE_NUMBER_INT);
		$uri=str_replace($int,'{id}',$uri);
		try{

		if(empty($this->routes[$requestType][$uri]))
			throw new Exception('Nemamo tu rutu');

		}catch(Exception $e){
			echo $e->getMessage();
			die();
		}
		$contorllerAction =(explode('@',$this->routes[$requestType][$uri]));
		$controller = $contorllerAction[0];
		$action = $contorllerAction[1];
		return $this->callAction($controller,$action,$int);

		if(array_key_exists($uri, $this->routes[$requestType])){
			return $this->routes[$requestType][$uri];	
		}
		throw new Exception("Nemamo taj ključ");
		
	}

	protected function callAction($controller, $action, $int){
		$controller = new $controller;
		$method = $action.'($id)';
	

		if(! method_exists($controller, $action)){
			throw new Exception("Ne postoji ta metoda");
		}
		return $controller->$action($int);
	}
}