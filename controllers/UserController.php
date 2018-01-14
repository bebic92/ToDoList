<?php

class UserController{


	public function create(){

		return view('registration/register');
	}
	public function store(){

		$user = [
		'firstName' => $_POST['firstName'],
		'lastName' => $_POST['lastName'],
		'email' => $_POST['email'],
		'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
		'registrationDate' => date('Y-m-d H:i:s'),
		'hash' => md5(rand(0,1000)) 
		];
		
		$errors = $this->validate($user);
		if(!empty($errors)){
			return view('registration/register',['errors' => $errors]);
		};
		
		User::create($user);

		$to = $_POST['email'];
		$subject = 'Potvrda računa';
		$message = 

		'Dobrodosli, uspjesno ste se registrirali, 

		za aktivaciju racuna kliknite na link:

		http://localhost:8000/Drugi_dio_b/verify/?email='.$user['email'].'&hash='.$user['hash']; 	
		
		mail($to, $subject, $message);

		return header('Location: /Drugi_dio_b/');
	}

	public function verify(){
		$email = $_GET['email'];
		$hash = $_GET['hash'];
		$user = App::get('database')->find('users','email',$email);


		if($user->status == 0 && $user->hash == $hash){
			App::get('database')->update('users','status',1,'id',$user->id);
		}else{
			
		}

		
	}
	protected function validate($user){
		$errors['email_req']= Validator::required($user['email']);
		$errors['is_email']= Validator::email($user['email']);
		$errors['email_unique'] = Validator::unique($user['email'],'users','email');
		$errors['email_max'] = Validator::max($user['email'],20);
		$errors['email_min'] = Validator::min($user['email'],4);
		foreach ($errors as $error) {
			if(!empty($error)){
				return $errors;
			}
		}
		return;
	}
}