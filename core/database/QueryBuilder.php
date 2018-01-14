<?php
class QueryBuilder{
	protected $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}
			

	public function getAll($table){

		$statment = $this->pdo->prepare("select * from $table");
		$statment->execute();
		return $statment->fetchAll(PDO::FETCH_CLASS); //dummy klasa
	}
	public function find($table, $rowName, $value){

		$sql = sprintf('SELECT %s FROM %s WHERE %s = "%s"',
			'*',
			$table,
			$rowName,
			$value
			);

		$statment = $this->pdo->prepare($sql);
		$statment->execute();
		return $statment->fetch(PDO::FETCH_OBJ); //dummy klasa
	}
	public function add($table, array $parameters){
		$sql = sprintf('INSERT INTO %s (%s) values (%s)',
			$table,
			implode(', ', array_keys($parameters)),
			':'. implode(', :',array_keys($parameters))
		);		
		$statment = $this->pdo->prepare($sql);
		$statment->execute($parameters);
	}
	public function update($table, $par, $par2, $rowName, $value){
		$sql=sprintf('UPDATE %s SET %s = "%s" where %s = "%s"',
			$table,
			$par,
			$par2,
			$rowName,
			$value
			);
		$statment=$this->pdo->prepare($sql);
		$statment->execute();

	}
}