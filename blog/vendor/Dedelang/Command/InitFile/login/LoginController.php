<?php

namespace Controllers;

use Dedelang\View\View;

use Models\LoginModel;

use Dedelang\Library\Authentication as Auth;

use Dedelang\Http\Request as req;

class LoginController{

	public static function index(){

		if(http_method()==="POST"){

			Auth::setPath('users','login')->doLogin();

		}else{

			View::render('Login');

		}

	}

	public static function register(){

		if(http_method()==="POST"){

			req::postAdd(['role'=>'users']);

			Auth::doRegister('users');

			View::render('Login');

		}else{

			View::render('Register');

		}

	}

	public static function Logout(){

		Auth::logout('login');

	}

}

?>
