<?php

class PagesController{
	public function main(){	
		//$tasks = App::get('database')->getAll('todos');
		$users = User::all();
		//require 'views/index.view.php';
		return view('index',[
			'users' => $users
			]);
	}
	public function contact()
	{
		return view('contact');
	}

	public function about(){
		return view('about');
	}

}