<?php

class UserController{


	public function create(){

		return view('registration/register');
	}
	public function signIn(){
		return view('registration/login');
	}
	public function store(){
		//dohvaćamo podatke koji su uneseni u formu
		$user = [
		'firstName' => $_POST['ime'],
		'lastName' => $_POST['prezime'],
		'email' => $_POST['email'],
		'password' => $_POST['lozinka'],
		'registrationDate' => date('Y-m-d H:i:s'),
		'hash' => md5(rand(0,1000)) 
		];
		//validiramo podatke, ako postoji koja greška vraćamo korisnika nazad s ispisom gresaka
		$errors = $this->registerValidation($user);
		if(!empty($errors)){
			return view('registration/register',['errors' => $errors]);
		};
		//kriptiramo lozinku(nismo prije zbog provjere ispravnosti u validaciji)
		$user['password'] = password_hash($_POST['lozinka'], PASSWORD_BCRYPT);
		//spremamo korisnika u bazu
		User::create($user);
		//saljemo email registriranom  korisniku za aktivaciju racuna
		$to = $_POST['email'];
		$subject = 'Potvrda računa';
		$message = 

		'Dobrodosli, uspjesno ste se registrirali, 

		za aktivaciju racuna kliknite na link:

		http://localhost:8000/Drugi_dio_b/verify/?email='.$user['email'].'&hash='.$user['hash']; 	
		
		mail($to, $subject, $message);
		$_SESSION['message_success'] = 
		'Uspjesno ste se registrirali, za aktivaciju racuna
		kliknite na poveznicu koju smo vam poslali na email';
		return header('Location: /Drugi_dio_b/registracija');
	}

	public function loginUser(){

		$email = $_POST['email'];
		$password = $_POST['lozinka'];
		$user = App::get('database')->find('users','email',$email);
		if(empty($user)){
			$_SESSION['message_danger'] ='Unijeli ste neispravnu email adresu';
			return header('Location: /Drugi_dio_b/login/');
		}
		if($user->status == 0){
			$_SESSION['message_danger'] =
			'Vaš račun nije aktiviran, 
			aktivirajte ga klikom na poveznicu koju smo vam poslali na vas email';
			return header('Location: /Drugi_dio_b/login/');
		}
		if(!password_verify($password, $user->password)){
			$_SESSION['message_danger'] = 'Unesena email adresa i lozinka se ne slazu';
			return header('Location: /Drugi_dio_b/login/');
		}

		App::get('database')->update('users','loginDate',date('Y-m-d H:i:s'),'id',$user->id);
		$user = App::get('database')->find('users','email',$email);

		$this->userSession($user);

		return header('Location: /Drugi_dio_b/');
	}
	public function logoutUser(){
		unset($_SESSION['user_id']);
		unset($_SESSION['ime']);
		unset($_SESSION['prezime']);
		return header('Location: /Drugi_dio_b/login');
	}
	protected function userSession($user){
		$_SESSION['user_id'] = $user->id;
		$_SESSION['ime'] = $user->firstName;
		$_SESSION['prezime'] = $user->lastName;
	}
	public function isLogin(){
		if(isset($_SESSION['id'])){
			return TRUE;
		}
		return FALSE;
	}
	public function verify(){
		$email = $_GET['email'];
		$hash = $_GET['hash'];
		$user = App::get('database')->find('users','email',$email);


		if($user->status == 0 && $user->hash == $hash){
			App::get('database')->update('users','status',1,'id',$user->id);
			$_SESSION['message_success'] = 
			'Uspjesno ste se aktivirali, 
			vas racun, mozete se prijaviti u sustav';
			return header('Location: /Drugi_dio_b/login');
		}else{
			$_SESSION['message_danger'] = 
			'Vec ste aktivirali vas racun, 
			ili poveznica na koju ste kliknuli nije ispravna';
			return header('Location: /Drugi_dio_b/login');
		}

		
	}

	protected function registerValidation($user){
		$emailField ='Email adresa';
		$firstNameField = 'Ime';
		$lastNameField = 'Prezime';
		$passwordField = 'Lozinka';
		//validacija emaila
		$errors['email_req']= Validator::required($user['email'],$emailField);
		$errors['is_email']= Validator::email($user['email']);
		$errors['email_unique'] = Validator::unique('users','email',$user['email'], $emailField);
		$errors['email_max'] = Validator::max($user['email'],$emailField,45);
		$errors['email_min'] = Validator::min($user['email'],$emailField,3);
		//validacija imena
		$errors['firstName_req']= Validator::required($user['firstName'],$firstNameField);
		$errors['firstName_max'] = Validator::max($user['firstName'],$firstNameField,45);
		$errors['firstName_min'] = Validator::min($user['firstName'],$firstNameField,1);
		//validacija prezimena
		$errors['lastName_req']= Validator::required($user['lastName'],$lastNameField);
		$errors['lastName_max'] = Validator::max($user['lastName'],$lastNameField,45);
		$errors['lastName_min'] = Validator::min($user['lastName'],$lastNameField,1);
		//validacija lozinke
		$errors['password_req']= Validator::required($user['password'],$passwordField);
		$errors['lastName_max'] = Validator::max($user['lastName'],$passwordField,45);
		$errors['lastName_min'] = Validator::min($user['lastName'],$passwordField,5);
		foreach ($errors as $error) {
			if(!empty($error)){
				return $errors;
			}
		}
		return;
	}
}