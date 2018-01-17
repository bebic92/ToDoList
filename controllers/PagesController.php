<?php

class PagesController{
	//početna stranica kojoj pristup imaju svi korisnici
	//mislio sam da ce ih biti vise zato sam napravio zaseban controller
	public function main(){	

		return view('index');
	}


}