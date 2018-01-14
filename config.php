<?php
return [
	'database' => [
		'type' =>'mysql',
		'connection' =>'host=localhost',
		'name' =>'todo',
		'username'=>'root',
		'password'=>'',
		'options' =>[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION//PRIKAZ GRESKI AKO NISMO NAVELI IME BAZE
		]
	]
];