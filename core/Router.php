<?php
class Router{
	protected $routes =[
		'GET' => [],
		'POST' => []
	];
	//spremamo putanje i controllere u određeni niz
	public function get($uri, $controller){
		$this->routes['GET'][$uri] = $controller;
	}
	public function post($uri, $controller){
		$this->routes['POST'][$uri] = $controller;
	}
	//dohvaćamo routes file
	public static function load($file){
		$router = new static;

		require $file;
		
		return $router;
	}
	//funkcija prima putanju i REQUEST TYPE(POST ili GET)
	public function direct($uri, $requestType){
		//id izdvajam u varijablu, nakon toga taj broj u putanji zamjenjujem (konstantom {id})
		//ovo nije najsretnije rijesenje no za potrebe ove aplikacije sluzi sasvim dobro
		$int = filter_var($uri, FILTER_SANITIZE_NUMBER_INT);
		$uri=str_replace($int,'{id}',$uri);
		try{
		//provjeravamo je li putanja registrirana u routes file-u	
		if(empty($this->routes[$requestType][$uri]))
			throw new Exception('Nemamo tu rutu');

		}catch(Exception $e){
			echo $e->getMessage();
			die();
		}
		//izdvajamo controller i akciju
		$contorllerAction =(explode('@',$this->routes[$requestType][$uri]));
		$controller = $contorllerAction[0];
		$action = $contorllerAction[1];
		// pozivamo metodu u kojoj pozivamo controller i metodu za proslijeđene parametre
		return $this->callAction($controller,$action,$int);

		if(array_key_exists($uri, $this->routes[$requestType])){
			return $this->routes[$requestType][$uri];	
		}
		throw new Exception("Nemamo taj ključ");
		
	}

	protected function callAction($controller, $action, $int){
		$controller = new $controller;
		if(! method_exists($controller, $action)){
			throw new Exception("Ne postoji ta metoda");
		}
		return $controller->$action($int);
	}
}