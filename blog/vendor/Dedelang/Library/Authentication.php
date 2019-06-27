<?php

namespace Dedelang\Library;

use Dedelang\Engine\DB\Query;

use Dedelang\Http\Session;

use Dedelang\Http\Cookie;

use Dedelang\Http\Url;

use Dedelang\Http\Request;

use Dedelang\Engine\Validate as vali;

class Authentication{

	protected static $table;

	protected static $where;

	protected static $username;

	protected static $password;

	protected static $salt;

	protected static $profile;

	protected static $successPath;

	protected static $failPath;

	protected static $numrows=0;



	public static function doRegister($table){

		self::passwordPolicyRegister();

		$salt = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 25);

		$password = hash('sha512', $salt.Request::post('password').$salt);

		Request::postAdd(['password'=>$password,"salt"=>$salt]);

		Request::postRemove(['password-repeat']);

		(TotalRows()? self::failLogin("Invalid process: username or email can't be same"):Query::save($table));

	}

	private static function passwordPolicyRegister(){

		self::$failPath = '/register';

		(strlen(Request::post('password')) < 8 ? self::failLogin("Invalid password policy: password must be more than 8 character") : '');

		(Request::post('password') != Request::post('password-repeat') ? self::failLogin("Invalid password policy: password don't match") :'');

		self::$numrows = Query::select("username,email")
										 ->table("users")
										 ->where("username","=",Request::post('username'))
										 ->or('email','=',Request::post('email'))
										 ->getAll();

	}

	public static function doLogin(){

		self::$username = Request::post('username');

		self::$password = Request::post('password');

		(empty(self::$username)? self::failLogin("Please insert empty field") : self::verifyUsername());

	 	(empty(self::$password)? self::failLogin("Please insert empty field") : self::verifyPassword());

		self::passwordPolicy();

		return new self();

	}

	public static function passwordPolicy(){

		(strlen(Request::post('password')) < 8 ? self::failLogin("Invalid password policy") : '');

	}

	private static function verifyUsername(){

		$result = Query::table('users')
						->select('salt')
						->where('username','=',self::$username)
						->getOne();

		($result ? self::$salt = $result->salt :self::failLogin());

	}

	private static function verifyPassword(){

		$password = self::hashing(self::$password);

		$result = Query::table('users')
						->select('id','firstname','lastname','username','email','role')
						->where('password','=',$password)
						->getOne();

		self::$profile = $result;

		($result ? self::set_profile():self::failLogin());

	}

	private static function hashing($password){

		$salt_value = self::$salt;

		return self::$password = hash('sha512', $salt_value.$password.$salt_value);

	}

 private static function set_profile(){

	 foreach (self::$profile as $key => $value) {

					Session::set($key, $value);

	 }

	 Url::redirect(self::$successPath);

 }

 private static function failLogin($msg = "Invalid Username or password"){

	 Cookie::set("FailLogin",$msg);

	 Url::redirect(self::$failPath);

	 die();
 }


 public static function setPath($successPath=null,$failPath=null){

	 self::$successPath = '/'.$successPath;

	 self::$failPath = '/'.$failPath;

	 return new self();
 }

 public static function logout($url = null){

	 session_destroy();

	 Url::redirect('/'.$url);

 }


}



 ?>
